import sharp from 'sharp';
import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __dirname  = path.dirname(fileURLToPath(import.meta.url));
const root       = path.join(__dirname, '..');
const imagesDir  = path.join(root, 'public', 'images');
const backupDir  = path.join(root, 'public', 'original-images-backup');

// ─── 1. Backup all originals ──────────────────────────────────────
console.log('\n── Backing up originals…');
fs.mkdirSync(backupDir, { recursive: true });
for (const file of fs.readdirSync(imagesDir)) {
    const src  = path.join(imagesDir, file);
    const dest = path.join(backupDir, file);
    if (fs.statSync(src).isFile() && !fs.existsSync(dest)) {
        fs.copyFileSync(src, dest);
        console.log(`   backed up: ${file}`);
    }
}

// ─── 2. Optimization targets ──────────────────────────────────────
// Note: originals are deleted after successful conversion (see Step 4)
const targets = [

    // Hero — full-viewport CSS background (keep native resolution, WebP)
    { input: 'hero.png',              output: 'hero.webp',
      resize: { width: 1536, withoutEnlargement: true },
      webp:   { quality: 83, effort: 5 },
      note: 'Hero background (CSS)' },

    // About — portrait photo displayed ~500px wide
    { input: 'aboutme.jpeg',          output: 'aboutme.webp',
      resize: { width: 800, withoutEnlargement: true },
      webp:   { quality: 84, effort: 5 },
      note: 'About section portrait' },

    // Brand logos — display height 128px; 256px = 2× retina
    ...['brand-groom-harry', 'brand-merkaba', 'brand-momo', 'brand-nk'].map(n => ({
        input:  `${n}.png`,
        output: `${n}.webp`,
        resize: { height: 256, withoutEnlargement: true, fit: 'inside' },
        webp:   { quality: 90, effort: 5 },
        note:   'Brand logo',
    })),

    // Site logo for <img> tags — display ~58px; 200px = ~3× retina
    { input: 'odanys_logo_final.png', output: 'odanys_logo_final.webp',
      resize: { width: 200, height: 200, fit: 'inside', withoutEnlargement: true },
      webp:   { quality: 90, effort: 5 },
      note: 'Site logo (img tags)' },

    // Site logo — keep small PNG for favicon/apple-touch-icon
    { input: 'odanys_logo_final.png', output: 'odanys_logo_final.png',
      resize: { width: 192, height: 192, fit: 'inside', withoutEnlargement: true },
      format: 'png',
      png:    { compressionLevel: 9 },
      note: 'Site logo (favicon PNG)' },

    // Portfolio posters — filmmaker portfolio; keep high quality
    { input: 'poster-me-llamas.jpg',  output: 'poster-me-llamas.webp',
      resize: { width: 1920, withoutEnlargement: true },
      webp:   { quality: 85, effort: 5 },
      note: 'Poster: Me Llamas (full)' },
    { input: 'poster-me-llamas.jpg',  output: 'poster-me-llamas-md.webp',
      resize: { width: 960, withoutEnlargement: true },
      webp:   { quality: 84, effort: 5 },
      note: 'Poster: Me Llamas (srcset 960w)' },
    { input: 'poster-pacto.jpg',      output: 'poster-pacto.webp',
      resize: { width: 1920, withoutEnlargement: true },
      webp:   { quality: 85, effort: 5 },
      note: 'Poster: Pacto (full)' },
    { input: 'poster-pacto.jpg',      output: 'poster-pacto-md.webp',
      resize: { width: 960, withoutEnlargement: true },
      webp:   { quality: 84, effort: 5 },
      note: 'Poster: Pacto (srcset 960w)' },

    // Services – Creative Direction (8000×4500, 16:9) → 1440×810
    ...['1','2','3','4','5'].map(n => ({
        input:  `srv-cd-${n}.png`,
        output: `srv-cd-${n}.webp`,
        resize: { width: 1440, height: 810, fit: 'cover', withoutEnlargement: true },
        webp:   { quality: 82, effort: 5 },
        note:   `Services CD slide ${n}`,
    })),

    // Services – Music Video (2880×2160, 4:3) → 1440×1080
    ...['1','2','3','4','5','6'].map(n => ({
        input:  `srv-mv-${n}.png`,
        output: `srv-mv-${n}.webp`,
        resize: { width: 1440, height: 1080, fit: 'cover', withoutEnlargement: true },
        webp:   { quality: 83, effort: 5 },
        note:   `Services MV slide ${n}`,
    })),

    // Services – Brand Films (4500×4500, square) → 1440×1440
    ...['1','2','3'].map(n => ({
        input:  `srv-bf-${n}.jpg`,
        output: `srv-bf-${n}.webp`,
        resize: { width: 1440, height: 1440, fit: 'cover', withoutEnlargement: true },
        webp:   { quality: 82, effort: 5 },
        note:   `Services BF slide ${n}`,
    })),
];

// ─── 3. Process targets ───────────────────────────────────────────
console.log('\n── Optimizing images…');
const report = [];

for (const t of targets) {
    const inputPath  = path.join(imagesDir, t.input);
    const outputPath = path.join(imagesDir, t.output);

    const beforeKB = Math.round(fs.statSync(inputPath).size / 1024);
    const origMeta = await sharp(inputPath).metadata();

    try {
        let pipeline = sharp(inputPath);
        if (t.resize) pipeline = pipeline.resize(t.resize);

        if (t.format === 'png') {
            await pipeline.png(t.png).toFile(outputPath);
        } else {
            await pipeline.webp(t.webp).toFile(outputPath);
        }

        const newMeta  = await sharp(outputPath).metadata();
        const afterKB  = Math.round(fs.statSync(outputPath).size / 1024);
        const pct      = ((1 - afterKB / beforeKB) * 100).toFixed(1);

        report.push({
            note: t.note,
            input: t.input,
            output: t.output,
            origDims:  `${origMeta.width}×${origMeta.height}`,
            newDims:   `${newMeta.width}×${newMeta.height}`,
            beforeKB,
            afterKB,
            reduction: pct,
        });
        console.log(`   ✓  ${t.input.padEnd(30)} → ${t.output.padEnd(30)} ${String(beforeKB+'KB').padEnd(10)} → ${afterKB}KB  (−${pct}%)`);
    } catch (err) {
        report.push({ note: t.note, input: t.input, output: t.output, error: err.message });
        console.error(`   ✗  ${t.input}: ${err.message}`);
    }
}

// ─── 4. Remove originals replaced by WebP ────────────────────────
const toDelete = [
    'hero.png',
    'aboutme.jpeg',
    'brand-groom-harry.png', 'brand-merkaba.png', 'brand-momo.png', 'brand-nk.png',
    'poster-me-llamas.jpg', 'poster-pacto.jpg',
    'srv-cd-1.png','srv-cd-2.png','srv-cd-3.png','srv-cd-4.png','srv-cd-5.png',
    'srv-mv-1.png','srv-mv-2.png','srv-mv-3.png','srv-mv-4.png','srv-mv-5.png','srv-mv-6.png',
    'srv-bf-1.jpg','srv-bf-2.jpg','srv-bf-3.jpg',
];
console.log('\n── Removing replaced originals…');
for (const f of toDelete) {
    const fp = path.join(imagesDir, f);
    if (fs.existsSync(fp)) { fs.unlinkSync(fp); console.log(`   deleted: ${f}`); }
}

// ─── 5. Report ────────────────────────────────────────────────────
console.log('\n' + '═'.repeat(120));
console.log('IMAGE OPTIMIZATION REPORT');
console.log('═'.repeat(120));
const h = ['Note','Input','Output','Orig Dims','New Dims','Before','After','Reduction'];
console.log(h[0].padEnd(34)+h[1].padEnd(28)+h[2].padEnd(28)+h[3].padEnd(16)+h[4].padEnd(14)+h[5].padEnd(10)+h[6].padEnd(10)+h[7]);
console.log('─'.repeat(120));
for (const r of report) {
    if (r.error) {
        console.log(`${r.note.padEnd(34)}${r.input.padEnd(28)} ERROR: ${r.error}`);
    } else {
        console.log(
            r.note.padEnd(34) + r.input.padEnd(28) + r.output.padEnd(28) +
            r.origDims.padEnd(16) + r.newDims.padEnd(14) +
            `${r.beforeKB}KB`.padEnd(10) + `${r.afterKB}KB`.padEnd(10) + `−${r.reduction}%`
        );
    }
}
const ok     = report.filter(r => !r.error);
const totBef = ok.reduce((s, r) => s + r.beforeKB, 0);
const totAft = ok.reduce((s, r) => s + r.afterKB,  0);
console.log('─'.repeat(120));
console.log(`TOTAL (${ok.length} images): ${totBef} KB → ${totAft} KB  (−${((1-totAft/totBef)*100).toFixed(1)}%)`);
console.log('═'.repeat(120));
