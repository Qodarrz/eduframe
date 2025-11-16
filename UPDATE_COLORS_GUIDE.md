# 🔄 Panduan Update Warna - Eduframe

## Quick Find & Replace Guide

Gunakan find & replace di editor Anda untuk mengubah warna lama ke warna baru dengan cepat.

### 1. Background Colors

#### Blue → Primary Purple
```
Find: bg-blue-500
Replace: style="background-color: #6155F5;"

Find: bg-blue-600
Replace: style="background-color: #4942c7;"

Find: from-blue-500 to-blue-600
Replace: style="background: linear-gradient(135deg, #6155F5 0%, #4942c7 100%);"

Find: bg-blue-50
Replace: style="background-color: rgba(97, 85, 245, 0.1);"

Find: hover:bg-blue-100
Replace: onmouseover="this.style.backgroundColor='rgba(97, 85, 245, 0.2)'" onmouseout="this.style.backgroundColor='rgba(97, 85, 245, 0.1)'"
```

#### Green → Teal
```
Find: bg-green-500
Replace: style="background-color: #00C2A8;"

Find: bg-green-600
Replace: style="background-color: #009688;"

Find: from-green-500 to-green-600
Replace: style="background: linear-gradient(135deg, #00C2A8 0%, #009688 100%);"

Find: bg-green-50
Replace: style="background-color: rgba(0, 194, 168, 0.1);"
```

#### Yellow → New Yellow
```
Find: bg-yellow-500
Replace: style="background-color: #FFC857;"

Find: bg-yellow-600
Replace: style="background-color: #FFB627;"

Find: from-yellow-500 to-yellow-600
Replace: style="background: linear-gradient(135deg, #FFC857 0%, #FFB627 100%);"

Find: bg-yellow-50
Replace: style="background-color: rgba(255, 200, 87, 0.1);"
```

#### Purple → Primary Purple
```
Find: bg-purple-500
Replace: style="background-color: #6155F5;"

Find: from-purple-500 to-purple-600
Replace: style="background: linear-gradient(135deg, #6155F5 0%, #4942c7 100%);"
```

#### Pink → Yellow-Teal Gradient
```
Find: bg-pink-500
Replace: style="background: linear-gradient(135deg, #FFC857 0%, #00C2A8 100%);"

Find: from-pink-500 to-pink-600
Replace: style="background: linear-gradient(135deg, #FFC857 0%, #00C2A8 100%);"
```

#### Indigo → Dark-Primary Gradient
```
Find: bg-indigo-500
Replace: style="background: linear-gradient(135deg, #1C1C2E 0%, #6155F5 100%);"

Find: from-indigo-500 to-indigo-600
Replace: style="background: linear-gradient(135deg, #1C1C2E 0%, #6155F5 100%);"
```

### 2. Text Colors

```
Find: text-blue-600
Replace: style="color: #6155F5;"

Find: text-blue-700
Replace: style="color: #4942c7;"

Find: text-green-600
Replace: style="color: #00C2A8;"

Find: text-yellow-400
Replace: style="color: #FFC857;"

Find: text-yellow-600
Replace: style="color: #FFC857;"

Find: text-purple-600
Replace: style="color: #6155F5;"

Find: text-pink-600
Replace: style="color: #FFC857;"

Find: text-indigo-600
Replace: style="color: #6155F5;"
```

### 3. Hover Text Colors

```
Find: hover:text-blue-600
Replace: onmouseover="this.style.color='#6155F5'" onmouseout="this.style.color='#1C1C2E'"

Find: hover:text-blue-700
Replace: onmouseover="this.style.color='#00C2A8'" onmouseout="this.style.color='#6155F5'"

Find: hover:text-yellow-600
Replace: onmouseover="this.style.color='#FFC857'" onmouseout="this.style.color='#1C1C2E'"
```

### 4. Border Colors

```
Find: border-blue-500
Replace: style="border-color: #6155F5;"

Find: border-green-500
Replace: style="border-color: #00C2A8;"

Find: border-yellow-500
Replace: style="border-color: #FFC857;"

Find: border-l-4 border-green-500
Replace: border-l-4 style="border-color: #00C2A8;"
```

### 5. Common Button Patterns

#### Primary Button (Blue → Purple)
```
Find: bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700
Replace: text-white rounded-lg font-semibold transition" style="background: linear-gradient(135deg, #6155F5 0%, #00C2A8 100%);" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'
```

#### CTA Button (Yellow)
```
Find: bg-yellow-500 text-white rounded-lg font-semibold hover:bg-yellow-600
Replace: text-white rounded-lg font-semibold transition" style="background: linear-gradient(135deg, #FFC857 0%, #FFB627 100%); color: #1C1C2E;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'
```

#### Success Button (Green → Teal)
```
Find: bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700
Replace: text-white rounded-lg font-semibold transition" style="background-color: #00C2A8;" onmouseover="this.style.backgroundColor='#009688'" onmouseout="this.style.backgroundColor='#00C2A8'
```

### 6. Card Patterns

#### Stats Card
```
Find: bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white
Replace: rounded-2xl p-6 text-white" style="background: linear-gradient(135deg, #6155F5 0%, #4942c7 100%);"
```

#### Light Card
```
Find: bg-gradient-to-br from-blue-50 to-blue-100
Replace: style="background: linear-gradient(135deg, rgba(97, 85, 245, 0.1) 0%, rgba(97, 85, 245, 0.2) 100%);"
```

### 7. Alert/Message Patterns

#### Success Alert
```
Find: bg-green-100 border-l-4 border-green-500 text-green-700
Replace: border-l-4" style="background-color: rgba(0, 194, 168, 0.1); border-color: #00C2A8; color: #00C2A8;"
```

#### Info Alert
```
Find: bg-blue-100 border-l-4 border-blue-500 text-blue-700
Replace: border-l-4" style="background-color: rgba(97, 85, 245, 0.1); border-color: #6155F5; color: #6155F5;"
```

#### Warning Alert
```
Find: bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700
Replace: border-l-4" style="background-color: rgba(255, 200, 87, 0.1); border-color: #FFC857; color: #FFC857;"
```

## Files Priority List

### High Priority (User-facing)
1. ✅ `resources/views/layouts/app.blade.php` - DONE
2. ✅ `resources/views/layouts/guest-app.blade.php` - DONE
3. ✅ `resources/views/dashboard.blade.php` - DONE
4. ✅ `resources/views/guest/home.blade.php` - DONE
5. `resources/views/guest/galeri.blade.php`
6. `resources/views/guest/agenda.blade.php`
7. `resources/views/guest/informasi.blade.php`

### Medium Priority (Admin forms)
8. `resources/views/foto/index.blade.php`
9. `resources/views/foto/create.blade.php`
10. `resources/views/foto/edit.blade.php`
11. `resources/views/kategori/index.blade.php`
12. `resources/views/kategori/create.blade.php`
13. `resources/views/kategori/edit.blade.php`
14. `resources/views/agenda/index.blade.php`
15. `resources/views/agenda/create.blade.php`
16. `resources/views/agenda/edit.blade.php`
17. `resources/views/informasi/index.blade.php`
18. `resources/views/informasi/create.blade.php`
19. `resources/views/informasi/edit.blade.php`

### Low Priority (Auth pages)
20. `resources/views/auth/login.blade.php`
21. `resources/views/auth/register.blade.php`

## Tips

1. **Backup dulu** - Commit perubahan sebelum melakukan mass replace
2. **Test per file** - Jangan replace semua file sekaligus
3. **Check visual** - Buka browser dan lihat hasilnya
4. **Konsistensi** - Gunakan palet warna yang sama di semua halaman
5. **Gradient** - Lebih baik gunakan gradient daripada solid color untuk tampilan modern

## Common Mistakes to Avoid

❌ Jangan: `bg-blue-500` (Tailwind class)
✅ Gunakan: `style="background-color: #6155F5;"` (Inline style)

❌ Jangan: Mix Tailwind dan inline style untuk warna yang sama
✅ Gunakan: Konsisten dengan inline style untuk custom colors

❌ Jangan: Hardcode hex tanpa dokumentasi
✅ Gunakan: Refer ke COLOR_SCHEME.md untuk consistency

## Testing Checklist

- [ ] Navbar terlihat dengan warna baru
- [ ] Sidebar admin dengan gradient purple
- [ ] Button CTA dengan gradient yellow
- [ ] Stats cards dengan warna yang sesuai
- [ ] Hover effects berfungsi dengan baik
- [ ] Text readable di semua background
- [ ] Mobile responsive tetap bagus
- [ ] Dark elements kontras dengan background
