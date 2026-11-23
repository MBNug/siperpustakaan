---
version: 1
slug: "app"
primary_target: "app"
related_targets: []
---

# Surface Brief — SIPerpustakaan Workspace

- **Scope & Mode:** Dual-surface library system: Public Visitor Attendance Kiosk (`/`) and Librarian Operations Console (`/login`, `/admin/dashboard`, `/book/*`, `/member/*`, `/borrow/*`), Operate mode (code-led).
- **Audience & Task:** Students/visitors checking in with their NIS at the front desk, and librarians monitoring weekly circulation, managing book stock, issuing/returning loans, and exporting Excel reports.
- **Constraints:** Neutral digital library branding (remove specific school names), keep public registration disabled, protect demo accounts when `DEMO_MODE=true`, and ensure zero null crashes on missing daily visitor rows.

## Direction contract

- **THESIS:** Library Circulation Desk refuses cluttered SB Admin boilerplate by giving the public entrance a calm instant NIS check-in desk while equipping librarians with a crisp inventory-first workspace anchored by live Stock Ratio Meters and overdue highlights.
- **OWN-WORLD:** Deep botanical forest-emerald navigation shell (`#0F3D2E`), daylight reading-room paper ground (`#F7F8F6`), crisp white work sheets (`#FFFFFF`), 1px linen borders (`#E2E6E1`), emerald primary CTAs (`#15803D`), and warm amber overdue/warning highlights (`#B45309`); set in `Onest` sans typography with `JetBrains Mono` tabular book codes, NIS IDs, and loan dates.
- **STORY:** A visitor arrives at `/` and checks in with one autocomplete-assisted NIS field and instant today's attendance confirmation; a librarian enters `/admin/dashboard`, sees today's circulation chart, active loans, overdue flags, and stock ratios immediately, and processes books, members, or returns in minimal clicks.
- **FIRST VIEWPORT:** On `/`, a calm centered check-in card framed by an emerald header band, clear NIS input with datalist lookup, one primary `Catat Kehadiran` CTA, and quick library stats; on `/admin/*`, a `248px` forest-emerald sidebar (`Dashboard`, `Kelola Buku`, `Anggota`, `Peminjaman`), clean top bar with quick actions, a 4-stat summary row, weekly Chart.js circulation graph alongside live stock/overdue overview.
- **FORM:** Library Circulation Desk, candidate 7 of 7 grounded directions, seed:e4c2ac01ebc5ba04. Raised with persistent amber emphasis on overdue/due-today loans and crisp outline-vs-solid button hierarchy.
- **FINISH:** unreviewed and undocumented is unfinished; this build ends with the finish review, the verdict, DESIGN.md, and every shipping raster carrying its provenance.
