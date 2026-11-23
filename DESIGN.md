---
name: SIPerpustakaan
description: Library Circulation Desk design system for digital visitor attendance and book circulation management.
colors:
  botanical-emerald: "#0f3d2e"
  botanical-deep: "#0a2c21"
  circulation-emerald: "#15803d"
  circulation-emerald-hover: "#166534"
  emerald-tint: "#ecfdf3"
  daylight-paper: "#f7f8f6"
  desk-sheet: "#ffffff"
  linen-subtle: "#f0f3ef"
  linen-hairline: "#e2e6e1"
  linen-strong: "#c9d1c7"
  botanical-ink: "#14221c"
  muted-sage: "#66776f"
  overdue-amber: "#b45309"
  overdue-amber-soft: "#fef3c7"
  overdue-amber-row: "#fffbeb"
  danger-crimson: "#b91c1c"
typography:
  display:
    fontFamily: "Onest, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif"
    fontSize: "1.5rem"
    fontWeight: 700
    lineHeight: 1.2
    letterSpacing: "-0.02em"
  title:
    fontFamily: "Onest, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif"
    fontSize: "1rem"
    fontWeight: 600
    lineHeight: 1.3
  body:
    fontFamily: "Onest, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif"
    fontSize: "0.875rem"
    fontWeight: 400
    lineHeight: 1.55
  mono:
    fontFamily: "JetBrains Mono, ui-monospace, SFMono-Regular, Menlo, monospace"
    fontSize: "0.8125rem"
    fontWeight: 500
    lineHeight: 1.4
rounded:
  sm: "6px"
  md: "10px"
  lg: "14px"
spacing:
  sm: "8px"
  md: "16px"
  lg: "26px"
components:
  button-primary:
    backgroundColor: "{colors.circulation-emerald}"
    textColor: "{colors.desk-sheet}"
    rounded: "{rounded.sm}"
    padding: "0 15px"
    height: "38px"
  button-primary-hover:
    backgroundColor: "{colors.circulation-emerald-hover}"
  desk-sheet:
    backgroundColor: "{colors.desk-sheet}"
    rounded: "{rounded.lg}"
    padding: "20px 22px"
  nav-shell:
    backgroundColor: "{colors.botanical-emerald}"
    textColor: "{colors.desk-sheet}"
    width: "248px"
---

# Design System: SIPerpustakaan

## Overview

**Creative North Star: "Library Circulation Desk"**

Library Circulation Desk pairs a quiet, inviting entrance kiosk (`/`) with an inventory-first librarian console (`/admin/*`). A deep botanical forest-emerald rail grounds operational tools on the left while daylight reading-room paper (`#f7f8f6`) keeps dense catalogs, member rosters, and active loans airy and scannable.

Rather than burying stock levels or late returns inside generic grey tables, the system foregrounds two signature domain signals: the **Live Stock Ratio Meter** (`Tersedia / Total`) on catalog entries and persistent warm-amber highlights (`#fffbeb` / `#b45309`) on overdue or due-today circulation rows.

**Key Characteristics:**
- Dual-surface architecture: calm standalone NIS check-in card on `/` and `248px` botanical-emerald console shell on `/admin/*`.
- **Live Stock Ratio Meter** per book showing remaining copies (`Tersedia / Total`) with automatic threshold tinting (`<= 2` amber, `0` crimson).
- Persistent overdue row highlighting (`#fffbeb`) and single-click return confirmation via inline SweetAlert prompts.
- Monospace tabular discipline (`JetBrains Mono`) for book codes, member NIS numbers, and due dates.

## Colors

The palette blends botanical reading-room calm with unmistakable overdue warning signals.

### Primary
- **Circulation Emerald** (`#15803d`): Primary CTAs (`Catat Kehadiran Sekarang`, `Peminjaman Baru`, `Kembalikan`, `Tambah Buku`), stock-available bars, and focus outlines.
- **Circulation Emerald Hover** (`#166534`): Hover state for solid primary controls.
- **Botanical Emerald** (`#0f3d2e`): Full-height librarian sidebar and auth split panel background.

### Semantic
- **Overdue Amber** (`#b45309` with `#fef3c7` badge and `#fffbeb` row tint): Active loans past or matching `tanggalwajibkembali`, plus low-stock (`<= 2`) meter warning.
- **Danger Crimson** (`#b91c1c`): Out-of-stock (`0 / N`) indicators, validation alerts, and delete controls.

### Neutral
- **Daylight Paper** (`#f7f8f6`): Canvas ground across admin and kiosk pages.
- **Desk Sheet** (`#ffffff`): Content containers, tables, forms, and check-in desk card.
- **Linen Hairline** (`#e2e6e1`): `1px` crisp structural borders around sheets and rows.
- **Botanical Ink** (`#14221c`): High-contrast primary copy and headings.
- **Muted Sage** (`#66776f`): Secondary table captions, dates, and field hints.

### Named Rules
**The Overdue Spotlight Rule.** Unreturned loans past `tanggalwajibkembali` carry a persistent subtle warm-amber row background (`#fffbeb`) and pill badge (`Telat X hari`) so late items never blend into normal circulation history.

## Typography

**Display & Body Font:** `Onest` (fallback: `-apple-system, BlinkMacSystemFont, Segoe UI, sans-serif`)
**Mono Font:** `JetBrains Mono` (fallback: `ui-monospace, SFMono-Regular, Menlo, monospace`)

**Character:** Warm geometric clarity in `Onest` for readable Indonesian UI copy, paired with `JetBrains Mono` (`tabular-nums`) for NIS entries, book codes, stock ratios, and circulation dates.

### Hierarchy
- **Display / Page Title** (`700`, `1.5rem`, `1.2` line-height): View headers and kiosk prompt title.
- **Title / Sheet Heading** (`650`, `1rem`, `1.3` line-height): Card headers inside white circulation sheets.
- **Body** (`400`, `0.875rem`, `1.55` line-height): Descriptions, form labels, and DataTable entries.
- **Mono / Code** (`500`, `0.8125rem`, `1.4` line-height): Book `kode`, `nis`, due dates, and numeric KPIs.

## Layout

Public entrance `/` centers a `560px` kiosk desk card over daylight paper with top bar linking directly to librarian login or dashboard. Admin console uses a fixed `248px` `#0f3d2e` sidebar collapsing into a mobile drawer at `991px`, sticky `62px` breadcrumb topbar, 4-column stat strip, and 2-column Chart.js + overdue-priority split panel on dashboard.

## Elevation & Depth

Sheets rely on subtle hairline borders (`1px solid #e2e6e1`) and whisper shadow (`0 1px 2px rgba(20, 34, 28, 0.04), 0 4px 14px rgba(20, 34, 28, 0.03)`), reserving slightly deeper ambient lift (`0 12px 36px rgba(15, 61, 46, 0.08)`) for the standalone kiosk check-in card.

### Named Rules
**The Linen-Edge Rule.** Admin tables, forms, and KPI tiles are separated by `1px solid #e2e6e1` edges on white sheets rather than heavy drop shadows or colored left border strips.

## Shapes

Friendly yet restrained radius ramp: `6px` inputs and buttons, `10px` stat tiles and alerts, `14px` work sheets, and `18px` centered kiosk desk card.

## Components

### Buttons
- **Shape:** `6px` border-radius, `38px` default height (`31px` `.btn-desk-sm` compact table row actions).
- **Primary:** Solid Circulation Emerald (`#15803d`), white bold label, darkens to `#166534`.
- **Secondary / Danger:** Crisp white outline (`1px solid #c9d1c7`) for edit/back/export; soft crimson (`#fef2f2` / `#b91c1c`) for delete buttons.

### Live Stock Ratio Meter
- **Style:** `6px` full-rounded `#e6eae5` track paired with tabular fraction (`Tersedia / Total`) and automatic semantic color fill (emerald healthy, amber `<= 2`, crimson `0`).

### Inputs / Fields
- **Style:** `40px` height (`52px` `.kiosk-input` on `/`), `1px solid #c9d1c7`, `6px` radius, `3px` emerald focus ring (`rgba(21, 128, 61, 0.14)`).

### Navigation
- **Style:** `248px` `#0f3d2e` rail with rounded `8px` links, active soft mint fill (`rgba(167, 243, 208, 0.16)`), and pinned bottom shortcut back to `/`.

## Do's and Don'ts

### Do:
- **Do** highlight overdue active loans persistently with `.is-overdue` amber row tint and `Telat X hari` badges.
- **Do** show the Live Stock Ratio Meter for catalog availability instead of plain integer counts alone.

### Don't:
- **Don't** include real-world school names or legacy template strings; keep neutral `SIPerpustakaan` identity.
- **Don't** route delete actions to standalone GET confirmation pages; confirm destructives inline via `.js-confirm-action` + DELETE POST forms.
