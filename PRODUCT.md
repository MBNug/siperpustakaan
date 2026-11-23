# Product

<!-- impeccable:product-schema 1 -->

## Platform

web

## Users

- **Pengunjung / Siswa (Public Kiosk `/`):** Checks in daily library attendance quickly using their member ID / NIS without needing an account.
- **Pustakawan / Admin (`/admin/*`, `/book`, `/member`, `/borrow`):** Monitors daily/weekly library circulation metrics, manages book catalog inventory, registers members, issues/returns loans, calculates late fees, and exports borrowing reports to Excel.
- **Portfolio Evaluators (in Demo Mode):** Visitors testing both the public attendance kiosk and the admin circulation console with daily auto-reset data.

## Product Purpose

SIPerpustakaan pairs a distraction-free public library attendance kiosk with an operational admin console for catalog management, member tracking, book lending/returns, and Excel reporting.

## Positioning

A two-surface library system combining instant public NIS attendance check-in with live stock-synced borrowing, overdue calculation, and weekly circulation analytics.

## Operating Context

- Dual environment: `/` acts as a fast front-desk kiosk screen for visitors; `/admin/*` acts as a librarian back-office workspace on desktop and tablet screens.
- Dual-mode deployment: must work reliably for real library operations and cleanly in public portfolio demo mode (`DEMO_MODE=true`).
- Core flows: Public NIS Attendance (`/`, `POST /absen`) -> Admin Login (`/login`, registration disabled) -> Dashboard (`/admin/dashboard`) -> Book CRUD (`/book`) -> Member CRUD & Loan History (`/member`) -> Borrow Issue, Return & Excel Export (`/borrow`).

## Capabilities and Constraints

- Built on Laravel 9 (PHP ^8.0.2), Laravel Fortify + Jetstream, Blade templates, DataTables/Bootstrap, Chart.js, and `maatwebsite/excel`.
- Public self-registration stays disabled; in `DEMO_MODE=true`, Fortify password/profile/2FA mutation features are disabled to protect shared demo login.
- Clunky multi-page confirmation/delete routes or overly verbose flows may be streamlined while keeping all core catalog, member, attendance, borrow/return, and Excel export features intact.

## Brand Commitments

- Neutral institutional identity: **SIPerpustakaan — Sistem Informasi Perpustakaan Digital**, removing specific school names (*SMK Darul/Daarul Khair Pulosari*) from titles, dashboard headings, and footers.

## Evidence on Hand

- Seeded catalog (12 books across 6 categories), 8 members (`DKP001`–`DKP008`), active/overdue/returned borrows, and dynamic daily visitor/loan metrics (`Carbon::today()`).
- No `PRODUCT.md` or `DESIGN.md` existed previously; visual world is being replaced.

## Product Principles

1. **Two surfaces, zero confusion:** The public attendance kiosk is immediate and forgiving; the librarian workspace is crisp, dense, and action-ready.
2. **Stock & date accuracy:** Book availability, active loans, late penalties, and daily attendance counters stay consistent and never break on missing daily rows.
3. **Fast circulation workflows:** Searchable tables, quick borrow/return actions, and inline confirmations cut repetitive clicks.
4. **Secure by default:** CSRF-protected state mutations, strict server-side validation, and safe error handling across both demo and production modes.
