# 🎨 Eduframe Color Scheme

## Palet Warna Utama

### Primary Colors
- **#6155F5** - Ungu utama (Primary)
  - Digunakan untuk: Sidebar, tombol utama, link aktif, heading
  - Gradient: `linear-gradient(135deg, #6155F5 0%, #4942c7 100%)`

- **#F5EFFF** - Ungu muda lembut (Light Background)
  - Digunakan untuk: Background halaman, card background
  
- **#00C2A8** - Hijau toska terang (Teal)
  - Digunakan untuk: Aksen, success messages, secondary buttons
  - Gradient dengan primary: `linear-gradient(135deg, #6155F5 0%, #00C2A8 100%)`

- **#FFC857** - Kuning keemasan hangat (Yellow)
  - Digunakan untuk: CTA buttons, highlights, badges
  - Gradient: `linear-gradient(135deg, #FFC857 0%, #FFB627 100%)`

- **#1C1C2E** - Biru gelap-kehitaman (Dark)
  - Digunakan untuk: Text, footer, dark elements
  - Gradient dengan primary: `linear-gradient(135deg, #1C1C2E 0%, #6155F5 100%)`

## Kombinasi Gradient yang Direkomendasikan

### 1. Primary Gradient
```css
background: linear-gradient(135deg, #6155F5 0%, #4942c7 100%);
```
**Penggunaan:** Stats cards, sidebar, primary buttons

### 2. Teal Gradient
```css
background: linear-gradient(135deg, #00C2A8 0%, #009688 100%);
```
**Penggunaan:** Success states, secondary cards

### 3. Yellow Gradient
```css
background: linear-gradient(135deg, #FFC857 0%, #FFB627 100%);
```
**Penggunaan:** CTA buttons, featured items, highlights

### 4. Primary-Teal Gradient
```css
background: linear-gradient(135deg, #6155F5 0%, #00C2A8 100%);
```
**Penggunaan:** Hero sections, special cards, mixed elements

### 5. Yellow-Teal Gradient
```css
background: linear-gradient(135deg, #FFC857 0%, #00C2A8 100%);
```
**Penggunaan:** Logo, badges, accent elements

### 6. Dark-Primary Gradient
```css
background: linear-gradient(135deg, #1C1C2E 0%, #6155F5 100%);
```
**Penggunaan:** Dark mode elements, footer sections

## Opacity Variants

### Light Backgrounds (untuk cards/sections)
```css
/* Primary light */
background: rgba(97, 85, 245, 0.1);

/* Teal light */
background: rgba(0, 194, 168, 0.1);

/* Yellow light */
background: rgba(255, 200, 87, 0.1);

/* Dark light */
background: rgba(28, 28, 46, 0.05);
```

### Hover States
```css
/* Primary hover */
background: rgba(97, 85, 245, 0.2);

/* Teal hover */
background: rgba(0, 194, 168, 0.2);

/* Yellow hover */
background: rgba(255, 200, 87, 0.2);

/* Dark hover */
background: rgba(28, 28, 46, 0.1);
```

## Text Colors

### Headings
- Primary heading: `#1C1C2E`
- Secondary heading: `#6155F5`
- Light heading (on dark bg): `#FFFFFF`

### Body Text
- Primary text: `#1C1C2E`
- Secondary text: `#6155F5`
- Muted text: `#6B7280` (gray-600)
- Light text: `rgba(255, 255, 255, 0.8)`

### Links
- Default: `#6155F5`
- Hover: `#00C2A8`
- Active: `#FFC857`

## Component-Specific Colors

### Buttons
**Primary Button:**
```css
background: linear-gradient(135deg, #6155F5 0%, #00C2A8 100%);
color: white;
```

**CTA Button:**
```css
background: linear-gradient(135deg, #FFC857 0%, #FFB627 100%);
color: #1C1C2E;
```

**Secondary Button:**
```css
background: transparent;
border: 2px solid #6155F5;
color: #6155F5;
```

### Cards
**Primary Card:**
```css
background: white;
border: 1px solid rgba(97, 85, 245, 0.1);
```

**Accent Card:**
```css
background: linear-gradient(135deg, rgba(97, 85, 245, 0.05) 0%, rgba(0, 194, 168, 0.05) 100%);
```

### Navigation
**Active Menu:**
```css
background: rgba(255, 200, 87, 0.2);
border-left: 4px solid #FFC857;
```

**Navbar Link:**
```css
color: #1C1C2E;
hover: #6155F5;
active: #FFC857;
```

### Alerts/Messages
**Success:**
```css
background: rgba(0, 194, 168, 0.1);
border-color: #00C2A8;
color: #00C2A8;
```

**Info:**
```css
background: rgba(97, 85, 245, 0.1);
border-color: #6155F5;
color: #6155F5;
```

**Warning:**
```css
background: rgba(255, 200, 87, 0.1);
border-color: #FFC857;
color: #FFC857;
```

**Error:**
```css
background: rgba(239, 68, 68, 0.1);
border-color: #EF4444;
color: #EF4444;
```

## Shadow Effects

### Card Shadow
```css
box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
```

### Button Glow (Primary)
```css
box-shadow: 0 0 20px rgba(97, 85, 245, 0.5);
hover: 0 0 30px rgba(97, 85, 245, 0.8);
```

### Button Glow (Yellow)
```css
box-shadow: 0 0 20px rgba(255, 200, 87, 0.5);
hover: 0 0 30px rgba(255, 200, 87, 0.8);
```

## Usage Guidelines

1. **Primary (#6155F5)** - Gunakan untuk elemen utama dan aksi penting
2. **Teal (#00C2A8)** - Gunakan untuk feedback positif dan elemen sekunder
3. **Yellow (#FFC857)** - Gunakan untuk CTA dan highlight yang perlu perhatian
4. **Dark (#1C1C2E)** - Gunakan untuk teks dan elemen yang perlu kontras tinggi
5. **Light BG (#F5EFFF)** - Gunakan untuk background halaman agar tidak terlalu putih

## Files Updated

✅ Layout Admin: `resources/views/layouts/app.blade.php`
✅ Layout Guest: `resources/views/layouts/guest-app.blade.php`
✅ Dashboard Admin: `resources/views/dashboard.blade.php`
✅ Home Guest: `resources/views/guest/home.blade.php`

## Files To Update (Manual)

Untuk konsistensi penuh, update file-file berikut dengan palet warna yang sama:
- `resources/views/guest/galeri.blade.php`
- `resources/views/guest/agenda.blade.php`
- `resources/views/guest/informasi.blade.php`
- `resources/views/foto/*.blade.php`
- `resources/views/kategori/*.blade.php`
- `resources/views/agenda/*.blade.php`
- `resources/views/informasi/*.blade.php`

Gunakan panduan warna di atas sebagai referensi.
