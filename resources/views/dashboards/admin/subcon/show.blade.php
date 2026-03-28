<x-layout>
@push('styles')
<style>
@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=IBM+Plex+Mono:wght@400;500;600&display=swap');

/* ================================
   KONRIX / SUBCON SHOW - REFINED
================================ */
:root {
  --ff: 'Outfit', sans-serif;
  --fm: 'IBM Plex Mono', monospace;

  --bg: #f5f7fb;
  --bg-soft: #eef3fb;
  --card: rgba(255,255,255,.82);
  --card-2: rgba(255,255,255,.62);
  --line: rgba(15,23,42,.08);
  --line-2: rgba(15,23,42,.12);

  --text: #0f172a;
  --text-2: #516079;
  --text-3: #8b98ae;

  --blue: #2563eb;
  --blue-2: #3b82f6;
  --blue-soft: rgba(37,99,235,.10);

  --violet: #7c3aed;
  --violet-2: #8b5cf6;
  --violet-soft: rgba(124,58,237,.10);

  --green: #059669;
  --green-soft: rgba(5,150,105,.10);

  --amber: #d97706;
  --amber-soft: rgba(217,119,6,.10);

  --rose: #e11d48;
  --rose-soft: rgba(225,29,72,.10);

  --radius-xs: 8px;
  --radius-sm: 12px;
  --radius: 16px;
  --radius-lg: 22px;
  --radius-xl: 28px;

  --shadow-sm: 0 8px 20px rgba(15,23,42,.04);
  --shadow: 0 18px 50px rgba(15,23,42,.08);
  --shadow-lg: 0 24px 80px rgba(15,23,42,.14);

  --sidebar-w: 300px;
}

.dark,
[data-theme="dark"],
html.dark,
body.dark {
  --bg: #08111f;
  --bg-soft: #0c1627;
  --card: rgba(14,23,38,.86);
  --card-2: rgba(18,29,48,.72);
  --line: rgba(255,255,255,.08);
  --line-2: rgba(255,255,255,.12);

  --text: #e5edf8;
  --text-2: #93a5c1;
  --text-3: #5d6f8a;

  --blue: #4c83ff;
  --blue-2: #6797ff;
  --blue-soft: rgba(76,131,255,.14);

  --violet: #9466ff;
  --violet-2: #a47cff;
  --violet-soft: rgba(148,102,255,.14);

  --green: #10b981;
  --green-soft: rgba(16,185,129,.14);

  --amber: #f59e0b;
  --amber-soft: rgba(245,158,11,.14);

  --rose: #f43f5e;
  --rose-soft: rgba(244,63,94,.14);

  --shadow-sm: 0 10px 30px rgba(0,0,0,.20);
  --shadow: 0 24px 60px rgba(0,0,0,.28);
  --shadow-lg: 0 30px 90px rgba(0,0,0,.42);
}

/* Base */
*,
*::before,
*::after { box-sizing: border-box; }

body {
  font-family: var(--ff);
  background:
    radial-gradient(circle at top left, rgba(37,99,235,.08), transparent 26%),
    radial-gradient(circle at top right, rgba(124,58,237,.07), transparent 20%),
    linear-gradient(180deg, var(--bg) 0%, var(--bg-soft) 100%);
  color: var(--text);
}

.page-content {
  background: transparent;
}

.col-span-full {
  padding: 8px;
}

/* Layout */
.sc-shell {
  display: grid;
  grid-template-columns: var(--sidebar-w) minmax(0,1fr);
  gap: 28px;
  align-items: start;
}

@media (max-width: 1080px) {
  .sc-shell {
    grid-template-columns: 1fr;
  }
}

.sc-sidebar {
  position: sticky;
  top: 24px;
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.sc-main {
  display: flex;
  flex-direction: column;
  gap: 22px;
  min-width: 0;
}

/* Shared glass card */
.sc-glass {
  background: var(--card);
  border: 1px solid var(--line);
  box-shadow: var(--shadow);
  backdrop-filter: blur(14px);
  -webkit-backdrop-filter: blur(14px);
}

/* Sidebar brand card */
.sc-brand {
  border-radius: var(--radius-xl);
  overflow: hidden;
  position: relative;
}

.sc-brand-top {
  height: 108px;
  background:
    radial-gradient(circle at 18% 28%, rgba(255,255,255,.22), transparent 26%),
    radial-gradient(circle at 80% 20%, rgba(255,255,255,.13), transparent 18%),
    linear-gradient(135deg, var(--blue) 0%, #4f46e5 45%, var(--violet) 100%);
}

.sc-brand-body {
  padding: 0 20px 20px;
}

.sc-logo-wrap {
  margin-top: -34px;
  margin-bottom: 14px;
}

.sc-logo {
  height: 70px;
  width: 70px;
  border-radius: 20px;
  background: linear-gradient(180deg, rgba(255,255,255,.95), rgba(255,255,255,.75));
  border: 4px solid rgba(255,255,255,.85);
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: var(--shadow);
  overflow: hidden;
}

.dark .sc-logo,
[data-theme="dark"] .sc-logo,
html.dark .sc-logo,
body.dark .sc-logo {
  background: linear-gradient(180deg, rgba(16,24,39,.96), rgba(24,35,56,.85));
  border-color: rgba(255,255,255,.08);
}

.sc-logo img {
  width: 100%;
  height: 100%;
  object-fit: contain;
  padding: 8px;
}

.sc-logo i {
  font-size: 26px;
  color: var(--blue);
}

.sc-subcon-name {
  font-size: 22px;
  line-height: 1.08;
  font-weight: 800;
  letter-spacing: -.03em;
  margin-bottom: 12px;
}

.sc-meta-row {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
}

.sc-chip {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  border-radius: 999px;
  padding: 7px 12px;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: .01em;
}

.sc-chip.blue {
  color: var(--blue);
  background: var(--blue-soft);
  border: 1px solid rgba(37,99,235,.16);
}

.sc-chip.violet {
  color: var(--violet);
  background: var(--violet-soft);
  border: 1px solid rgba(124,58,237,.16);
}

.sc-side-card {
  border-radius: var(--radius-lg);
  overflow: hidden;
}

.sc-side-head {
  padding: 13px 16px;
  border-bottom: 1px solid var(--line);
  font-size: 10px;
  font-weight: 800;
  letter-spacing: .10em;
  text-transform: uppercase;
  color: var(--text-3);
  background: var(--card-2);
}

.sc-side-row {
  display: flex;
  gap: 12px;
  padding: 14px 16px;
  border-bottom: 1px solid var(--line);
}

.sc-side-row:last-child {
  border-bottom: none;
}

.sc-side-icon {
  width: 30px;
  height: 30px;
  border-radius: 10px;
  flex-shrink: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  background: var(--bg-soft);
  color: var(--text-3);
  border: 1px solid var(--line);
}

.sc-side-label {
  font-size: 10px;
  font-weight: 800;
  letter-spacing: .08em;
  text-transform: uppercase;
  color: var(--text-3);
  margin-bottom: 4px;
}

.sc-side-value {
  font-size: 13px;
  color: var(--text);
  line-height: 1.45;
  word-break: break-word;
}

.sc-side-value.mono {
  font-family: var(--fm);
  font-size: 11.5px;
  color: var(--text-2);
}

.sc-side-value.empty {
  color: var(--text-3);
  font-style: italic;
}

/* Top bar */
.sc-topbar {
  display: flex;
  justify-content: space-between;
  gap: 16px;
  flex-wrap: wrap;
  align-items: flex-start;
}

.sc-breadcrumb {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 9px 13px;
  border-radius: 999px;
  background: var(--card);
  border: 1px solid var(--line);
  box-shadow: var(--shadow-sm);
  font-size: 10px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: .08em;
  color: var(--text-3);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
}

.sc-breadcrumb a {
  text-decoration: none;
  color: var(--blue);
}

.sc-breadcrumb a:hover {
  color: var(--violet);
}

.sc-hero {
  display: flex;
  justify-content: space-between;
  gap: 18px;
  flex-wrap: wrap;
  padding: 22px;
  border-radius: var(--radius-xl);
}

.sc-hero-copy h1 {
  font-size: 30px;
  line-height: 1;
  letter-spacing: -.04em;
  font-weight: 800;
  margin: 0 0 8px;
}

.sc-hero-copy p {
  margin: 0;
  font-size: 14px;
  color: var(--text-2);
  max-width: 680px;
}

.sc-stats {
  display: grid;
  grid-template-columns: repeat(4, minmax(120px, 1fr));
  gap: 12px;
  width: 100%;
}

@media (max-width: 900px) {
  .sc-stats {
    grid-template-columns: repeat(2, minmax(0,1fr));
  }
}

.sc-stat {
  background: var(--card-2);
  border: 1px solid var(--line);
  border-radius: 18px;
  padding: 15px 16px;
  min-height: 92px;
}

.sc-stat-k {
  font-size: 10px;
  letter-spacing: .10em;
  text-transform: uppercase;
  font-weight: 800;
  color: var(--text-3);
  margin-bottom: 10px;
}

.sc-stat-v {
  font-size: 28px;
  font-weight: 800;
  line-height: 1;
  letter-spacing: -.04em;
}

.sc-stat-s {
  margin-top: 8px;
  font-size: 11px;
  color: var(--text-2);
  font-family: var(--fm);
}

/* Section card */
.sc-card {
  border-radius: var(--radius-xl);
  overflow: hidden;
}

.sc-card-head {
  padding: 18px 22px;
  border-bottom: 1px solid var(--line);
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 12px;
  flex-wrap: wrap;
  background: var(--card-2);
}

.sc-card-title {
  display: flex;
  align-items: center;
  gap: 11px;
  font-size: 15px;
  font-weight: 800;
}

.sc-card-icon {
  width: 34px;
  height: 34px;
  border-radius: 11px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 14px;
}

.sc-card-icon.blue {
  background: var(--blue-soft);
  border: 1px solid rgba(37,99,235,.16);
  color: var(--blue);
}

.sc-card-icon.violet {
  background: var(--violet-soft);
  border: 1px solid rgba(124,58,237,.16);
  color: var(--violet);
}

/* Buttons */
.sc-btn {
  appearance: none;
  border: none;
  outline: none;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 9px 15px;
  border-radius: 12px;
  font-size: 12px;
  font-weight: 800;
  font-family: var(--ff);
  transition: transform .18s ease, box-shadow .18s ease, filter .18s ease, background .18s ease;
  white-space: nowrap;
}

.sc-btn:hover {
  transform: translateY(-1px);
}

.sc-btn:disabled {
  opacity: .65;
  cursor: not-allowed;
  transform: none;
}

.sc-btn-blue {
  color: #fff;
  background: linear-gradient(135deg, var(--blue), var(--blue-2));
  box-shadow: 0 12px 28px rgba(37,99,235,.24);
}

.sc-btn-violet {
  color: #fff;
  background: linear-gradient(135deg, var(--violet), var(--violet-2));
  box-shadow: 0 12px 28px rgba(124,58,237,.22);
}

.sc-btn-ghost {
  color: var(--text-2);
  background: var(--card-2);
  border: 1px solid var(--line-2);
}

.sc-btn-ghost:hover {
  color: var(--text);
}

.sc-btn-danger {
  color: #fff;
  background: linear-gradient(135deg, var(--rose), #fb7185);
  box-shadow: 0 12px 28px rgba(225,29,72,.18);
}

/* Members */
.sc-members-wrap {
  padding: 10px 14px 14px;
}

.sc-member-row {
  display: grid;
  grid-template-columns: minmax(0, 1.2fr) 160px 120px 54px;
  align-items: center;
  gap: 10px;
  padding: 14px 12px;
  border-bottom: 1px solid var(--line);
  border-radius: 16px;
  transition: background .16s ease, transform .16s ease;
}

.sc-member-row:hover {
  background: rgba(37,99,235,.04);
}

.sc-member-row:last-child {
  border-bottom: none;
}

@media (max-width: 820px) {
  .sc-member-row {
    grid-template-columns: 1fr;
    gap: 8px;
  }
}

.sc-person {
  display: flex;
  align-items: center;
  gap: 12px;
  min-width: 0;
}

.sc-avatar {
  width: 42px;
  height: 42px;
  border-radius: 14px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  color: #fff;
  font-size: 13px;
  font-weight: 800;
  background: linear-gradient(135deg, var(--blue), var(--violet));
  box-shadow: 0 10px 22px rgba(37,99,235,.18);
}

.sc-person-copy {
  min-width: 0;
}

.sc-person-name {
  font-size: 14px;
  font-weight: 800;
  color: var(--text);
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.sc-person-mail {
  font-family: var(--fm);
  font-size: 11px;
  color: var(--text-3);
  margin-top: 3px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.sc-badge {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  padding: 5px 10px;
  border-radius: 999px;
  font-size: 10px;
  font-weight: 800;
  letter-spacing: .04em;
  text-transform: uppercase;
}

.sc-badge.pm {
  color: var(--amber);
  background: var(--amber-soft);
  border: 1px solid rgba(217,119,6,.18);
}

.sc-badge.lineman {
  color: var(--green);
  background: var(--green-soft);
  border: 1px solid rgba(5,150,105,.18);
}

.sc-joined {
  font-size: 11px;
  font-family: var(--fm);
  color: var(--text-2);
}

.sc-icon-btn {
  width: 34px;
  height: 34px;
  border-radius: 11px;
  border: 1px solid var(--line-2);
  background: var(--card-2);
  color: var(--text-3);
  display: inline-flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all .15s ease;
}

.sc-icon-btn:hover {
  color: var(--rose);
  border-color: rgba(225,29,72,.18);
  background: var(--rose-soft);
}

.sc-icon-btn.sm {
  width: 28px;
  height: 28px;
  border-radius: 9px;
  font-size: 12px;
}

/* Empty */
.sc-empty {
  padding: 46px 20px;
  text-align: center;
}

.sc-empty-ico {
  width: 52px;
  height: 52px;
  border-radius: 16px;
  margin: 0 auto 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  color: var(--text-3);
  background: var(--bg-soft);
  border: 1px solid var(--line);
}

.sc-empty-title {
  font-size: 15px;
  font-weight: 800;
  color: var(--text-2);
  margin-bottom: 4px;
}

.sc-empty-sub {
  font-size: 12px;
  color: var(--text-3);
}

/* Teams */
.sc-teams-wrap {
  padding: 16px;
  display: grid;
  gap: 14px;
}

.sc-team {
  border: 1px solid var(--line);
  background: var(--card-2);
  border-radius: 20px;
  overflow: hidden;
  box-shadow: var(--shadow-sm);
}

.sc-team-head {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 12px;
  flex-wrap: wrap;
  padding: 16px 18px;
  border-bottom: 1px solid var(--line);
}

.sc-team-left {
  display: flex;
  align-items: center;
  gap: 12px;
}

.sc-team-icon {
  width: 38px;
  height: 38px;
  border-radius: 13px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--violet);
  background: var(--violet-soft);
  border: 1px solid rgba(124,58,237,.16);
  font-size: 15px;
}

.sc-team-name {
  font-size: 15px;
  font-weight: 800;
  line-height: 1.1;
}

.sc-team-meta {
  margin-top: 4px;
  font-size: 10.5px;
  font-family: var(--fm);
  color: var(--text-3);
}

.sc-team-actions {
  display: flex;
  align-items: center;
  gap: 8px;
}

.sc-assign-btn {
  border: 1px solid rgba(124,58,237,.16);
  background: var(--violet-soft);
  color: var(--violet);
  border-radius: 10px;
  padding: 8px 12px;
  font-size: 11px;
  font-weight: 800;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  transition: all .16s ease;
}

.sc-assign-btn:hover {
  transform: translateY(-1px);
  filter: brightness(.97);
}

.sc-team-body {
  padding: 10px 18px 14px;
}

.sc-team-member {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 12px 0;
  border-top: 1px dashed var(--line);
}

.sc-team-member:first-child {
  border-top: none;
}

.sc-team-avatar {
  width: 30px;
  height: 30px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, var(--violet), var(--blue));
  color: #fff;
  font-size: 11px;
  font-weight: 800;
  flex-shrink: 0;
}

.sc-team-member-name {
  font-size: 13px;
  font-weight: 700;
  color: var(--text);
}

.sc-team-no {
  font-size: 11px;
  font-family: var(--fm);
  color: var(--text-3);
  padding: 8px 0 2px;
}

.sc-teams-empty {
  padding: 32px 20px;
  text-align: center;
  font-size: 12px;
  font-family: var(--fm);
  color: var(--text-3);
}

/* Overlay / modal */
.sc-ov {
  position: fixed;
  inset: 0;
  z-index: 900;
  background: rgba(3,8,20,.50);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 16px;
  opacity: 0;
  pointer-events: none;
  transition: opacity .22s ease;
}

.sc-ov.open {
  opacity: 1;
  pointer-events: all;
}

.sc-modal {
  width: 100%;
  max-width: 520px;
  background: var(--card);
  border: 1px solid var(--line-2);
  border-radius: 28px;
  box-shadow: var(--shadow-lg);
  transform: translateY(12px) scale(.98);
  opacity: 0;
  transition: transform .24s cubic-bezier(.34,1.2,.64,1), opacity .22s ease;
  overflow: hidden;
  backdrop-filter: blur(18px);
  -webkit-backdrop-filter: blur(18px);
}

.sc-modal.sm {
  max-width: 400px;
}

.sc-ov.open .sc-modal {
  transform: translateY(0) scale(1);
  opacity: 1;
}

.sc-modal-head {
  display: flex;
  align-items: flex-start;
  gap: 12px;
  padding: 18px 20px;
  border-bottom: 1px solid var(--line);
  background: var(--card-2);
}

.sc-modal-icon {
  width: 38px;
  height: 38px;
  border-radius: 12px;
  flex-shrink: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 16px;
}

.sc-modal-icon.blue {
  background: var(--blue-soft);
  border: 1px solid rgba(37,99,235,.16);
  color: var(--blue);
}

.sc-modal-icon.violet {
  background: var(--violet-soft);
  border: 1px solid rgba(124,58,237,.16);
  color: var(--violet);
}

.sc-modal-icon.rose {
  background: var(--rose-soft);
  border: 1px solid rgba(225,29,72,.16);
  color: var(--rose);
}

.sc-modal-title {
  font-size: 15px;
  font-weight: 800;
}

.sc-modal-sub {
  margin-top: 3px;
  font-size: 12px;
  color: var(--text-3);
  line-height: 1.45;
}

.sc-modal-close {
  margin-left: auto;
  width: 30px;
  height: 30px;
  border-radius: 10px;
  border: 1px solid var(--line-2);
  background: var(--card-2);
  color: var(--text-3);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
}

.sc-modal-close:hover {
  color: var(--rose);
  background: var(--rose-soft);
  border-color: rgba(225,29,72,.18);
}

.sc-modal-body {
  padding: 18px 20px;
}

.sc-modal-foot {
  padding: 14px 20px 20px;
  display: flex;
  justify-content: flex-end;
  gap: 8px;
  border-top: 1px solid var(--line);
}

.sc-form {
  display: grid;
  gap: 14px;
}

.sc-grid-2 {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 12px;
}

@media (max-width: 640px) {
  .sc-grid-2 {
    grid-template-columns: 1fr;
  }
}

.sc-field label {
  display: block;
  margin-bottom: 6px;
  font-size: 10px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: .08em;
  color: var(--text-3);
}

.sc-field label span {
  color: var(--rose);
}

.sc-input {
  width: 100%;
  border: 1px solid var(--line-2);
  background: var(--card-2);
  color: var(--text);
  border-radius: 14px;
  padding: 11px 13px;
  font-size: 13px;
  font-family: var(--ff);
  outline: none;
  transition: border-color .16s ease, box-shadow .16s ease, background .16s ease;
}

.sc-input::placeholder {
  color: var(--text-3);
}

.sc-input:focus {
  border-color: rgba(37,99,235,.35);
  box-shadow: 0 0 0 4px rgba(37,99,235,.10);
}

.sc-err {
  margin-top: 6px;
  font-size: 11px;
  color: var(--rose);
  font-weight: 700;
  font-family: var(--fm);
}

.sc-inline-stat {
  display: grid;
  grid-template-columns: repeat(4, minmax(0,1fr));
  gap: 10px;
  margin-bottom: 6px;
}

@media (max-width: 640px) {
  .sc-inline-stat {
    grid-template-columns: repeat(2, minmax(0,1fr));
  }
}

.sc-inline-box {
  padding: 12px;
  border-radius: 16px;
  background: var(--card-2);
  border: 1px solid var(--line);
}

.sc-inline-k {
  font-size: 9px;
  letter-spacing: .10em;
  text-transform: uppercase;
  font-weight: 800;
  color: var(--text-3);
  margin-bottom: 8px;
}

.sc-inline-v {
  font-size: 20px;
  line-height: 1;
  font-weight: 800;
  letter-spacing: -.03em;
}

/* Assign list */
.sc-assign-list {
  max-height: 340px;
  overflow-y: auto;
}

.sc-assign-item {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 12px 0;
  border-bottom: 1px solid var(--line);
}

.sc-assign-item:last-child {
  border-bottom: none;
}

/* Toast */
.sc-toast {
  position: fixed;
  right: 18px;
  bottom: 18px;
  z-index: 9999;
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 12px 16px;
  border-radius: 14px;
  color: #fff;
  font-size: 13px;
  font-weight: 800;
  box-shadow: var(--shadow-lg);
  transform: translateY(12px);
  opacity: 0;
  pointer-events: none;
  transition: all .22s cubic-bezier(.34,1.2,.64,1);
}

.sc-toast.show {
  transform: translateY(0);
  opacity: 1;
}

.sc-toast.ok {
  background: linear-gradient(135deg, var(--green), #34d399);
}

.sc-toast.err {
  background: linear-gradient(135deg, var(--rose), #fb7185);
}
</style>
@endpush

<div class="col-span-full">
  <div class="sc-shell">

    {{-- SIDEBAR --}}
    <aside class="sc-sidebar">
      <div class="sc-brand sc-glass">
        <div class="sc-brand-top"></div>
        <div class="sc-brand-body">
          <div class="sc-logo-wrap">
            <div class="sc-logo">
              @if($subcon->logo_url)
                <img src="{{ $subcon->logo_url }}" alt="{{ $subcon->name }}">
              @else
                <i class="mgc_building_4_line"></i>
              @endif
            </div>
          </div>

          <div class="sc-subcon-name">{{ $subcon->name }}</div>

          <div class="sc-meta-row">
            <span class="sc-chip blue">
              <i class="mgc_group_line"></i>
              {{ $members->count() }} {{ Str::plural('member', $members->count()) }}
            </span>
            <span class="sc-chip violet">
              <i class="mgc_group_3_line"></i>
              {{ $teams->count() }} {{ Str::plural('team', $teams->count()) }}
            </span>
          </div>
        </div>
      </div>

      @if($subcon->email || $subcon->contact)
      <div class="sc-side-card sc-glass">
        <div class="sc-side-head">Contact</div>

        @if($subcon->email)
        <div class="sc-side-row">
          <div class="sc-side-icon"><i class="mgc_mail_line"></i></div>
          <div>
            <div class="sc-side-label">Email</div>
            <div class="sc-side-value mono">{{ $subcon->email }}</div>
          </div>
        </div>
        @endif

        @if($subcon->contact)
        <div class="sc-side-row">
          <div class="sc-side-icon"><i class="mgc_phone_line"></i></div>
          <div>
            <div class="sc-side-label">Phone</div>
            <div class="sc-side-value mono">{{ $subcon->contact }}</div>
          </div>
        </div>
        @endif
      </div>
      @endif

      <div class="sc-side-card sc-glass">
        <div class="sc-side-head">Details</div>

        <div class="sc-side-row">
          <div class="sc-side-icon"><i class="mgc_location_line"></i></div>
          <div>
            <div class="sc-side-label">Address</div>
            <div class="sc-side-value {{ !$subcon->address ? 'empty' : '' }}">
              {{ $subcon->address ?: 'Not specified' }}
            </div>
          </div>
        </div>

        <div class="sc-side-row">
          <div class="sc-side-icon"><i class="mgc_store_2_line"></i></div>
          <div>
            <div class="sc-side-label">Warehouse</div>
            <div class="sc-side-value {{ !$subcon->warehouse ? 'empty' : '' }}">
              {{ $subcon->warehouse ?: 'Not specified' }}
            </div>
          </div>
        </div>

        <div class="sc-side-row">
          <div class="sc-side-icon"><i class="mgc_file_line"></i></div>
          <div>
            <div class="sc-side-label">Description</div>
            <div class="sc-side-value {{ !$subcon->description ? 'empty' : '' }}">
              {{ $subcon->description ?: 'No description' }}
            </div>
          </div>
        </div>
      </div>
    </aside>

    {{-- MAIN --}}
    <section class="sc-main">

      <div class="sc-topbar">
        <div class="sc-breadcrumb">
          <a href="{{ route('admin.subcons.index') }}">
            <i class="mgc_left_line"></i> Subcontractors
          </a>
          <span>/</span>
          <span>{{ $subcon->name }}</span>
        </div>
      </div>

      <div class="sc-hero sc-glass">
        <div class="sc-hero-copy">
          <h1>{{ $subcon->name }}</h1>
          <p>Manage members and teams in one place. Clean, focused, and modal-driven for a more minimalist workflow.</p>
        </div>

        <div class="sc-stats">
          <div class="sc-stat">
            <div class="sc-stat-k">Members</div>
            <div class="sc-stat-v" id="statMembers">{{ $members->count() }}</div>
            <div class="sc-stat-s">Total users</div>
          </div>
          <div class="sc-stat">
            <div class="sc-stat-k">Teams</div>
            <div class="sc-stat-v" id="statTeams">{{ $teams->count() }}</div>
            <div class="sc-stat-s">Active groups</div>
          </div>
          <div class="sc-stat">
            <div class="sc-stat-k">PM</div>
            <div class="sc-stat-v" id="statPm">{{ $members->where('subcon_role', 'pm')->count() }}</div>
            <div class="sc-stat-s">Project managers</div>
          </div>
          <div class="sc-stat">
            <div class="sc-stat-k">Lineman</div>
            <div class="sc-stat-v" id="statLineman">{{ $members->where('subcon_role', 'lineman')->count() }}</div>
            <div class="sc-stat-s">Field members</div>
          </div>
        </div>
      </div>

      {{-- MEMBERS --}}
      <div class="sc-card sc-glass">
        <div class="sc-card-head">
          <div class="sc-card-title">
            <span class="sc-card-icon blue"><i class="mgc_group_line"></i></span>
            Members
          </div>

          <button class="sc-btn sc-btn-blue" id="btnAddMember" type="button">
            <i class="mgc_user_add_line"></i>
            Add Member
          </button>
        </div>

        <div class="sc-members-wrap" id="membersBody">
          @forelse($members as $member)
            <div class="sc-member-row" id="row-{{ $member->id }}"
                 data-role="{{ $member->subcon_role }}">
              <div class="sc-person">
                <div class="sc-avatar">{{ strtoupper(substr($member->name, 0, 2)) }}</div>
                <div class="sc-person-copy">
                  <div class="sc-person-name">{{ $member->name }}</div>
                  <div class="sc-person-mail">{{ $member->email }}</div>
                </div>
              </div>

              <div>
                @if($member->subcon_role === 'pm')
                  <span class="sc-badge pm"><i class="mgc_briefcase_line"></i> Project Manager</span>
                @else
                  <span class="sc-badge lineman"><i class="mgc_tool_line"></i> Lineman</span>
                @endif
              </div>

              <div class="sc-joined">{{ $member->created_at->format('M d, Y') }}</div>

              <div style="text-align:right;">
                <button class="sc-icon-btn remove-member"
                  type="button"
                  data-id="{{ $member->id }}"
                  data-name="{{ $member->name }}"
                  title="Remove member">
                  <i class="mgc_delete_2_line"></i>
                </button>
              </div>
            </div>
          @empty
            <div id="emptyMembers">
              <div class="sc-empty">
                <div class="sc-empty-ico"><i class="mgc_user_x_line"></i></div>
                <div class="sc-empty-title">No members yet</div>
                <div class="sc-empty-sub">Add a PM or Lineman to get started.</div>
              </div>
            </div>
          @endforelse
        </div>
      </div>

      {{-- TEAMS --}}
      <div class="sc-card sc-glass">
        <div class="sc-card-head">
          <div class="sc-card-title">
            <span class="sc-card-icon violet"><i class="mgc_group_3_line"></i></span>
            Teams
          </div>

          <button class="sc-btn sc-btn-violet" id="btnAddTeam" type="button">
            <i class="mgc_add_line"></i>
            Add Team
          </button>
        </div>

        <div class="sc-teams-wrap" id="teamsContainer">
          @forelse($teams as $team)
            <div class="sc-team" id="tc-{{ $team->id }}">
              <div class="sc-team-head">
                <div class="sc-team-left">
                  <div class="sc-team-icon"><i class="mgc_group_line"></i></div>
                  <div>
                    <div class="sc-team-name">{{ $team->team_name }}</div>
                    <div class="sc-team-meta">
                      <span class="team-count-label">{{ $team->members->count() }} {{ Str::plural('member', $team->members->count()) }}</span>
                    </div>
                  </div>
                </div>

                <div class="sc-team-actions">
                  <button class="sc-assign-btn assign-team-btn"
                    type="button"
                    data-id="{{ $team->id }}"
                    data-name="{{ $team->team_name }}">
                    <i class="mgc_user_add_line"></i>
                    Assign
                  </button>

                  <button class="sc-icon-btn del-team-btn"
                    type="button"
                    data-id="{{ $team->id }}"
                    data-name="{{ $team->team_name }}"
                    title="Delete team">
                    <i class="mgc_delete_2_line"></i>
                  </button>
                </div>
              </div>

              <div class="sc-team-body team-members-{{ $team->id }}">
                @forelse($team->members as $member)
                  <div class="sc-team-member" id="tm-{{ $team->id }}-{{ $member->id }}">
                    <div class="sc-team-avatar">{{ strtoupper(substr($member->name, 0, 2)) }}</div>

                    <div style="flex:1;display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
                      <span class="sc-team-member-name">{{ $member->name }}</span>
                      @if($member->subcon_role === 'pm')
                        <span class="sc-badge pm"><i class="mgc_briefcase_line"></i> PM</span>
                      @else
                        <span class="sc-badge lineman"><i class="mgc_tool_line"></i> Lineman</span>
                      @endif
                    </div>

                    <button class="sc-icon-btn sm remove-team-member"
                      type="button"
                      data-team="{{ $team->id }}"
                      data-user="{{ $member->id }}"
                      data-name="{{ $member->name }}"
                      title="Remove from team">
                      <i class="mgc_close_line"></i>
                    </button>
                  </div>
                @empty
                  <div class="sc-team-no no-members-{{ $team->id }}">No members assigned yet.</div>
                @endforelse
              </div>
            </div>
          @empty
            <div id="teamsEmpty" class="sc-teams-empty">
              <i class="mgc_group_line" style="font-size:24px;display:block;margin-bottom:10px;"></i>
              No teams yet. Create one above.
            </div>
          @endforelse
        </div>
      </div>

    </section>
  </div>
</div>

{{-- ADD MEMBER --}}
<div id="addOv" class="sc-ov">
  <div class="sc-modal">
    <div class="sc-modal-head">
      <div class="sc-modal-icon blue"><i class="mgc_user_add_line"></i></div>
      <div>
        <div class="sc-modal-title">Add Member</div>
        <div class="sc-modal-sub">Everything stays minimal here — add member details and track totals in one modal.</div>
      </div>
      <button class="sc-modal-close" id="btnCloseAdd" type="button">
        <i class="mgc_close_line"></i>
      </button>
    </div>

    <div class="sc-modal-body">
      <div class="sc-inline-stat">
        <div class="sc-inline-box">
          <div class="sc-inline-k">Members</div>
          <div class="sc-inline-v">{{ $members->count() }}</div>
        </div>
        <div class="sc-inline-box">
          <div class="sc-inline-k">Teams</div>
          <div class="sc-inline-v">{{ $teams->count() }}</div>
        </div>
        <div class="sc-inline-box">
          <div class="sc-inline-k">PM</div>
          <div class="sc-inline-v">{{ $members->where('subcon_role', 'pm')->count() }}</div>
        </div>
        <div class="sc-inline-box">
          <div class="sc-inline-k">Lineman</div>
          <div class="sc-inline-v">{{ $members->where('subcon_role', 'lineman')->count() }}</div>
        </div>
      </div>

      <form id="addForm"
        method="POST"
        action="{{ route('admin.subcons.members.store', $subcon) }}"
        class="sc-form"
        novalidate>
        @csrf

        <div class="sc-grid-2">
          <div class="sc-field">
            <label for="mName">Full Name <span>*</span></label>
            <input id="mName" name="name" class="sc-input" type="text" placeholder="e.g. Juan dela Cruz" required value="{{ old('name') }}">
            @error('name') <div class="sc-err">{{ $message }}</div> @enderror
          </div>

          <div class="sc-field">
            <label for="mEmail">Email <span>*</span></label>
            <input id="mEmail" name="email" class="sc-input" type="email" placeholder="e.g. juan@subcon.com" required value="{{ old('email') }}">
            @error('email') <div class="sc-err">{{ $message }}</div> @enderror
          </div>
        </div>

        <div class="sc-grid-2">
          <div class="sc-field">
            <label for="mRole">Role <span>*</span></label>
            <select id="mRole" name="subcon_role" class="sc-input" required>
              <option value="" disabled {{ old('subcon_role') ? '' : 'selected' }}>Select role…</option>
              <option value="pm" {{ old('subcon_role') === 'pm' ? 'selected' : '' }}>Project Manager</option>
              <option value="lineman" {{ old('subcon_role') === 'lineman' ? 'selected' : '' }}>Lineman</option>
            </select>
            @error('subcon_role') <div class="sc-err">{{ $message }}</div> @enderror
          </div>

          <div class="sc-field">
            <label for="mPassword">Password <span>*</span></label>
            <input id="mPassword" name="password" class="sc-input" type="password" placeholder="Minimum 8 characters" required>
            @error('password') <div class="sc-err">{{ $message }}</div> @enderror
          </div>
        </div>
      </form>
    </div>

    <div class="sc-modal-foot">
      <button class="sc-btn sc-btn-ghost" id="btnCancelAdd" type="button">Cancel</button>
      <button class="sc-btn sc-btn-blue" id="btnSaveMember" type="button">
        <i class="mgc_user_add_line"></i>
        Add Member
      </button>
    </div>
  </div>
</div>

{{-- REMOVE MEMBER --}}
<div id="delOv" class="sc-ov">
  <div class="sc-modal sm">
    <div class="sc-modal-head">
      <div class="sc-modal-icon rose"><i class="mgc_delete_2_line"></i></div>
      <div>
        <div class="sc-modal-title">Remove Member?</div>
        <div class="sc-modal-sub" id="delMsg">This will remove the member from this subcontractor.</div>
      </div>
      <button class="sc-modal-close" id="btnDelClose" type="button"><i class="mgc_close_line"></i></button>
    </div>

    <div class="sc-modal-foot" style="border-top:none;padding-top:16px;">
      <button class="sc-btn sc-btn-ghost" id="btnDelCancel" type="button">Cancel</button>
      <button class="sc-btn sc-btn-danger" id="btnDelConfirm" type="button">
        <i class="mgc_delete_2_line"></i>
        Remove
      </button>
    </div>
  </div>
</div>

{{-- ADD TEAM --}}
<div id="addTeamOv" class="sc-ov">
  <div class="sc-modal sm">
    <div class="sc-modal-head">
      <div class="sc-modal-icon violet"><i class="mgc_group_line"></i></div>
      <div>
        <div class="sc-modal-title">Create Team</div>
        <div class="sc-modal-sub">Keep team setup simple and clean.</div>
      </div>
      <button class="sc-modal-close" id="btnCloseAddTeam" type="button"><i class="mgc_close_line"></i></button>
    </div>

    <div class="sc-modal-body">
      <div class="sc-field">
        <label for="tTeamName">Team Name <span>*</span></label>
        <input id="tTeamName" class="sc-input" type="text" placeholder="e.g. Alpha Team">
        <div id="tTeamErr" class="sc-err" style="display:none;"></div>
      </div>
    </div>

    <div class="sc-modal-foot">
      <button class="sc-btn sc-btn-ghost" id="btnCancelAddTeam" type="button">Cancel</button>
      <button class="sc-btn sc-btn-violet" id="btnSaveTeam" type="button">
        <i class="mgc_add_line"></i>
        Create Team
      </button>
    </div>
  </div>
</div>

{{-- ASSIGN MEMBER --}}
<div id="assignOv" class="sc-ov">
  <div class="sc-modal">
    <div class="sc-modal-head">
      <div class="sc-modal-icon violet"><i class="mgc_user_add_line"></i></div>
      <div>
        <div class="sc-modal-title">Assign Member</div>
        <div class="sc-modal-sub" id="assignSubtitle">Pick an unassigned member</div>
      </div>
      <button class="sc-modal-close" id="btnCloseAssign" type="button"><i class="mgc_close_line"></i></button>
    </div>

    <div class="sc-modal-body sc-assign-list" id="assignList">
      <div style="color:var(--text-3);font-size:12px;text-align:center;padding:24px 0;">Loading…</div>
    </div>

    <div class="sc-modal-foot">
      <button class="sc-btn sc-btn-ghost" id="btnCancelAssign" type="button">Close</button>
    </div>
  </div>
</div>

{{-- DELETE TEAM --}}
<div id="delTeamOv" class="sc-ov">
  <div class="sc-modal sm">
    <div class="sc-modal-head">
      <div class="sc-modal-icon rose"><i class="mgc_delete_2_line"></i></div>
      <div>
        <div class="sc-modal-title">Delete Team?</div>
        <div class="sc-modal-sub" id="delTeamMsg">All members will be unassigned from this team.</div>
      </div>
      <button class="sc-modal-close" id="btnDelTeamClose" type="button"><i class="mgc_close_line"></i></button>
    </div>

    <div class="sc-modal-foot" style="border-top:none;padding-top:16px;">
      <button class="sc-btn sc-btn-ghost" id="btnDelTeamCancel" type="button">Cancel</button>
      <button class="sc-btn sc-btn-danger" id="btnDelTeamConfirm" type="button">
        <i class="mgc_delete_2_line"></i>
        Delete
      </button>
    </div>
  </div>
</div>

{{-- TOAST --}}
<div id="scToast" class="sc-toast">
  <i id="scToastIco"></i>
  <span id="scToastMsg"></span>
</div>

@push('scripts')
<script>
(function(){
  const CSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  const $toast = {
    wrap: document.getElementById('scToast'),
    msg: document.getElementById('scToastMsg'),
    ico: document.getElementById('scToastIco'),
    timer: null
  };

  function toast(message, ok = true){
    $toast.msg.textContent = message;
    $toast.ico.className = ok ? 'mgc_check_circle_line' : 'mgc_close_circle_line';
    $toast.wrap.className = 'sc-toast show ' + (ok ? 'ok' : 'err');
    clearTimeout($toast.timer);
    $toast.timer = setTimeout(() => $toast.wrap.classList.remove('show'), 2800);
  }

  function openModal(el){
    el.classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function closeModal(el){
    el.classList.remove('open');
    document.body.style.overflow = '';
  }

  function initialLetters(name){
    return (name || '').trim().substring(0,2).toUpperCase();
  }

  function roleBadge(role, short = false){
    if(role === 'pm'){
      return short
        ? `<span class="sc-badge pm"><i class="mgc_briefcase_line"></i> PM</span>`
        : `<span class="sc-badge pm"><i class="mgc_briefcase_line"></i> Project Manager</span>`;
    }
    return short
      ? `<span class="sc-badge lineman"><i class="mgc_tool_line"></i> Lineman</span>`
      : `<span class="sc-badge lineman"><i class="mgc_tool_line"></i> Lineman</span>`;
  }

  function updateTopStats(){
    const rows = document.querySelectorAll('.sc-member-row[id^="row-"]');
    const total = rows.length;
    let pm = 0, lineman = 0;

    rows.forEach(r => {
      const role = r.dataset.role;
      if(role === 'pm') pm++;
      if(role === 'lineman') lineman++;
    });

    document.getElementById('statMembers').textContent = total;
    document.getElementById('statPm').textContent = pm;
    document.getElementById('statLineman').textContent = lineman;
    document.getElementById('statTeams').textContent = document.querySelectorAll('.sc-team').length;
  }

  /* ADD MEMBER */
  const addOv = document.getElementById('addOv');
  const addForm = document.getElementById('addForm');

  document.getElementById('btnAddMember').onclick = () => openModal(addOv);
  ['btnCloseAdd','btnCancelAdd'].forEach(id => {
    document.getElementById(id).onclick = () => closeModal(addOv);
  });
  addOv.addEventListener('click', e => {
    if(e.target === addOv) closeModal(addOv);
  });
  document.getElementById('btnSaveMember').onclick = () => addForm.submit();

  @if($errors->any())
    openModal(addOv);
  @endif

  /* REMOVE MEMBER */
  const delOv = document.getElementById('delOv');
  let pendingDelId = null;
  let pendingDelUrl = null;

  function openDel(id, name, url){
    pendingDelId = id;
    pendingDelUrl = url;
    document.getElementById('delMsg').textContent = `Remove "${name}" from this subcontractor?`;
    openModal(delOv);
  }

  function closeDel(){
    closeModal(delOv);
    pendingDelId = null;
    pendingDelUrl = null;
  }

  ['btnDelCancel','btnDelClose'].forEach(id => {
    document.getElementById(id).onclick = closeDel;
  });

  delOv.addEventListener('click', e => {
    if(e.target === delOv) closeDel();
  });

  document.getElementById('btnDelConfirm').addEventListener('click', async () => {
    if(!pendingDelUrl) return;

    try {
      const res = await fetch(pendingDelUrl, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': CSRF,
          'Accept': 'application/json'
        }
      });

      if(!res.ok) throw new Error();

      document.getElementById('row-' + pendingDelId)?.remove();

      document.querySelectorAll(`.remove-team-member[data-user="${pendingDelId}"]`).forEach(btn => {
        document.getElementById(`tm-${btn.dataset.team}-${pendingDelId}`)?.remove();
        updateTeamCount(btn.dataset.team);
        ensureNoMembersLabel(btn.dataset.team);
      });

      localUnassigned = localUnassigned.filter(x => x.id != pendingDelId);

      if(!document.querySelector('.sc-member-row[id^="row-"]')){
        document.getElementById('membersBody').innerHTML = `
          <div id="emptyMembers">
            <div class="sc-empty">
              <div class="sc-empty-ico"><i class="mgc_user_x_line"></i></div>
              <div class="sc-empty-title">No members yet</div>
              <div class="sc-empty-sub">Add a PM or Lineman to get started.</div>
            </div>
          </div>`;
      }

      closeDel();
      updateTopStats();
      toast('Member removed.');
    } catch (e) {
      toast('Could not remove member.', false);
      closeDel();
    }
  });

  function bindRemoveMemberButtons(scope = document){
    scope.querySelectorAll('.remove-member').forEach(btn => {
      btn.onclick = () => openDel(
        btn.dataset.id,
        btn.dataset.name,
        `{{ url('admin/subcons/members') }}/${btn.dataset.id}`
      );
    });
  }

  bindRemoveMemberButtons();

  /* ADD TEAM */
  const addTeamOv = document.getElementById('addTeamOv');

  document.getElementById('btnAddTeam').onclick = () => openModal(addTeamOv);

  ['btnCloseAddTeam','btnCancelAddTeam'].forEach(id => {
    document.getElementById(id).onclick = () => {
      closeModal(addTeamOv);
      document.getElementById('tTeamName').value = '';
      document.getElementById('tTeamErr').style.display = 'none';
    };
  });

  addTeamOv.addEventListener('click', e => {
    if(e.target === addTeamOv) closeModal(addTeamOv);
  });

  document.getElementById('btnSaveTeam').addEventListener('click', async () => {
    const name = document.getElementById('tTeamName').value.trim();
    const errEl = document.getElementById('tTeamErr');
    const btn = document.getElementById('btnSaveTeam');

    if(!name){
      errEl.textContent = 'Team name is required.';
      errEl.style.display = 'block';
      return;
    }

    errEl.style.display = 'none';
    btn.disabled = true;

    try {
      const res = await fetch(`{{ route('admin.subcons.teams.store', $subcon) }}`, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': CSRF,
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        body: JSON.stringify({ team_name: name })
      });

      const data = await res.json();

      if(!res.ok || !data.success){
        toast(data.message || 'Failed to create team.', false);
        return;
      }

      document.getElementById('teamsEmpty')?.remove();

      const t = data.team;
      const card = document.createElement('div');
      card.className = 'sc-team';
      card.id = `tc-${t.id}`;
      card.innerHTML = `
        <div class="sc-team-head">
          <div class="sc-team-left">
            <div class="sc-team-icon"><i class="mgc_group_line"></i></div>
            <div>
              <div class="sc-team-name">${t.team_name}</div>
              <div class="sc-team-meta">
                <span class="team-count-label">0 members</span>
              </div>
            </div>
          </div>

          <div class="sc-team-actions">
            <button class="sc-assign-btn assign-team-btn" type="button" data-id="${t.id}" data-name="${t.team_name}">
              <i class="mgc_user_add_line"></i>
              Assign
            </button>
            <button class="sc-icon-btn del-team-btn" type="button" data-id="${t.id}" data-name="${t.team_name}" title="Delete team">
              <i class="mgc_delete_2_line"></i>
            </button>
          </div>
        </div>
        <div class="sc-team-body team-members-${t.id}">
          <div class="sc-team-no no-members-${t.id}">No members assigned yet.</div>
        </div>
      `;

      document.getElementById('teamsContainer').appendChild(card);
      bindTeamButtons(card);
      updateTopStats();

      closeModal(addTeamOv);
      document.getElementById('tTeamName').value = '';
      toast('Team created.');
    } catch (e) {
      toast('Network error.', false);
    } finally {
      btn.disabled = false;
    }
  });

  /* ASSIGN MEMBER */
  const assignOv = document.getElementById('assignOv');
  let activeTeamId = null;
  let activeTeamName = null;
  let localUnassigned = @json($members->whereNull('team_id')->values());
  const allMembers = @json($members->values());

  function openAssign(id, name){
    activeTeamId = id;
    activeTeamName = name;
    document.getElementById('assignSubtitle').textContent = `Assign to "${name}"`;
    openModal(assignOv);
    renderAssignList();
  }

  function closeAssign(){
    closeModal(assignOv);
    activeTeamId = null;
    activeTeamName = null;
  }

  ['btnCloseAssign','btnCancelAssign'].forEach(id => {
    document.getElementById(id).onclick = closeAssign;
  });

  assignOv.addEventListener('click', e => {
    if(e.target === assignOv) closeAssign();
  });

  function renderAssignList(){
    const list = document.getElementById('assignList');

    if(!localUnassigned.length){
      list.innerHTML = `<div style="color:var(--text-3);font-family:var(--fm);font-size:12px;text-align:center;padding:24px 0;">No unassigned members available.</div>`;
      return;
    }

    list.innerHTML = localUnassigned.map(u => `
      <div class="sc-assign-item" id="al-${u.id}">
        <div class="sc-avatar">${initialLetters(u.name)}</div>
        <div style="flex:1;min-width:0;">
          <div class="sc-person-name">${u.name}</div>
          <div class="sc-person-mail">${u.email || (u.subcon_role === 'pm' ? 'Project Manager' : 'Lineman')}</div>
        </div>
        <button class="sc-btn sc-btn-violet do-assign-btn"
          type="button"
          data-uid="${u.id}"
          data-uname="${u.name}"
          data-urole="${u.subcon_role}"
          style="padding:7px 12px;font-size:11px;">
          <i class="mgc_user_add_line"></i>
          Add
        </button>
      </div>
    `).join('');

    list.querySelectorAll('.do-assign-btn').forEach(btn => {
      btn.addEventListener('click', async () => {
        const uid = btn.dataset.uid;
        const uname = btn.dataset.uname;
        const urole = btn.dataset.urole;

        btn.disabled = true;
        btn.innerHTML = '...';

        try {
          const res = await fetch(`{{ url('admin/subcons/teams') }}/${activeTeamId}/members`, {
            method: 'POST',
            headers: {
              'X-CSRF-TOKEN': CSRF,
              'Content-Type': 'application/json',
              'Accept': 'application/json'
            },
            body: JSON.stringify({ user_id: uid })
          });

          const data = await res.json();

          if(!res.ok || !data.success){
            toast('Failed to assign.', false);
            btn.disabled = false;
            btn.innerHTML = '<i class="mgc_user_add_line"></i> Add';
            return;
          }

          localUnassigned = localUnassigned.filter(x => x.id != uid);
          document.getElementById(`al-${uid}`)?.remove();

          const body = document.querySelector(`.team-members-${activeTeamId}`);
          if(body){
            body.querySelector('.sc-team-no')?.remove();

            const row = document.createElement('div');
            row.className = 'sc-team-member';
            row.id = `tm-${activeTeamId}-${uid}`;
            row.innerHTML = `
              <div class="sc-team-avatar">${initialLetters(uname)}</div>
              <div style="flex:1;display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
                <span class="sc-team-member-name">${uname}</span>
                ${roleBadge(urole, true)}
              </div>
              <button class="sc-icon-btn sm remove-team-member"
                type="button"
                data-team="${activeTeamId}"
                data-user="${uid}"
                data-name="${uname}"
                title="Remove from team">
                <i class="mgc_close_line"></i>
              </button>
            `;
            body.appendChild(row);
            bindRemoveTeamMember(row.querySelector('.remove-team-member'));
          }

          updateTeamCount(activeTeamId);
          renderAssignList();
          toast(`${uname} assigned to ${activeTeamName}.`);
        } catch (e) {
          toast('Network error.', false);
          btn.disabled = false;
          btn.innerHTML = '<i class="mgc_user_add_line"></i> Add';
        }
      });
    });
  }

  function updateTeamCount(teamId){
    const card = document.getElementById(`tc-${teamId}`);
    if(!card) return;

    const count = card.querySelectorAll(`[id^="tm-${teamId}-"]`).length;
    const label = card.querySelector('.team-count-label');
    if(label){
      label.textContent = `${count} ${count === 1 ? 'member' : 'members'}`;
    }
  }

  function ensureNoMembersLabel(teamId){
    const body = document.querySelector(`.team-members-${teamId}`);
    if(!body) return;

    const members = body.querySelectorAll(`[id^="tm-${teamId}-"]`);
    if(!members.length && !body.querySelector('.sc-team-no')){
      const empty = document.createElement('div');
      empty.className = `sc-team-no no-members-${teamId}`;
      empty.textContent = 'No members assigned yet.';
      body.appendChild(empty);
    }
  }

  /* REMOVE TEAM MEMBER */
  function bindRemoveTeamMember(btn){
    btn.addEventListener('click', async () => {
      const tid = btn.dataset.team;
      const uid = btn.dataset.user;
      const name = btn.dataset.name;

      try {
        const res = await fetch(`{{ url('admin/subcons/teams') }}/${tid}/members/${uid}`, {
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': CSRF,
            'Accept': 'application/json'
          }
        });

        const data = await res.json();

        if(!res.ok || !data.success){
          toast('Failed to remove.', false);
          return;
        }

        document.getElementById(`tm-${tid}-${uid}`)?.remove();
        updateTeamCount(tid);
        ensureNoMembersLabel(tid);

        const member = allMembers.find(x => x.id == uid);
        if(member && !localUnassigned.find(x => x.id == uid)){
          localUnassigned.push(member);
        }

        toast(`${name} removed from team.`);
      } catch (e) {
        toast('Network error.', false);
      }
    });
  }

  document.querySelectorAll('.remove-team-member').forEach(btn => bindRemoveTeamMember(btn));

  /* DELETE TEAM */
  const delTeamOv = document.getElementById('delTeamOv');
  let pendingDelTeamId = null;

  function openDelTeam(id, name){
    pendingDelTeamId = id;
    document.getElementById('delTeamMsg').textContent = `Delete team "${name}"? All members will be unassigned.`;
    openModal(delTeamOv);
  }

  function closeDelTeam(){
    closeModal(delTeamOv);
    pendingDelTeamId = null;
  }

  ['btnDelTeamCancel','btnDelTeamClose'].forEach(id => {
    document.getElementById(id).onclick = closeDelTeam;
  });

  delTeamOv.addEventListener('click', e => {
    if(e.target === delTeamOv) closeDelTeam();
  });

  document.getElementById('btnDelTeamConfirm').addEventListener('click', async () => {
    if(!pendingDelTeamId) return;

    const btn = document.getElementById('btnDelTeamConfirm');
    btn.disabled = true;

    try {
      const res = await fetch(`{{ url('admin/subcons/teams') }}/${pendingDelTeamId}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': CSRF,
          'Accept': 'application/json'
        }
      });

      const data = await res.json();

      if(!res.ok || !data.success){
        toast('Failed to delete team.', false);
        return;
      }

      document.getElementById(`tc-${pendingDelTeamId}`)?.remove();

      if(!document.querySelector('.sc-team')){
        const div = document.createElement('div');
        div.id = 'teamsEmpty';
        div.className = 'sc-teams-empty';
        div.innerHTML = `<i class="mgc_group_line" style="font-size:24px;display:block;margin-bottom:10px;"></i>No teams yet. Create one above.`;
        document.getElementById('teamsContainer').appendChild(div);
      }

      updateTopStats();
      closeDelTeam();
      toast('Team deleted.');
    } catch (e) {
      toast('Network error.', false);
    } finally {
      btn.disabled = false;
    }
  });

  function bindTeamButtons(scope){
    scope.querySelectorAll('.assign-team-btn').forEach(btn => {
      btn.onclick = () => openAssign(btn.dataset.id, btn.dataset.name);
    });

    scope.querySelectorAll('.del-team-btn').forEach(btn => {
      btn.onclick = () => openDelTeam(btn.dataset.id, btn.dataset.name);
    });
  }

  document.querySelectorAll('.sc-team').forEach(team => bindTeamButtons(team));

  /* ESC */
  document.addEventListener('keydown', e => {
    if(e.key !== 'Escape') return;
    [addOv, delOv, addTeamOv, assignOv, delTeamOv]
      .find(m => m.classList.contains('open'))
      ?.classList.remove('open');
    document.body.style.overflow = '';
  });

  @if(session('success'))
    toast(@json(session('success')));
  @endif

  updateTopStats();
})();
</script>
@endpush
</x-layout>