<x-layout>
@push('styles')
<style>
@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=IBM+Plex+Mono:wght@400;500;600&display=swap');

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

.page-content { background: transparent; }
.col-span-full { padding: 8px; }

.sc-shell {
  display: grid;
  grid-template-columns: var(--sidebar-w) minmax(0,1fr);
  gap: 28px;
  align-items: start;
}

@media (max-width: 1080px) {
  .sc-shell { grid-template-columns: 1fr; }
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

.sc-glass {
  background: var(--card);
  border: 1px solid var(--line);
  box-shadow: var(--shadow);
  backdrop-filter: blur(14px);
  -webkit-backdrop-filter: blur(14px);
}

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

.sc-brand-body { padding: 0 20px 20px; }

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

.sc-side-row:last-child { border-bottom: none; }

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

.sc-breadcrumb a:hover { color: var(--violet); }

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
  .sc-stats { grid-template-columns: repeat(2, minmax(0,1fr)); }
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

.sc-btn:hover { transform: translateY(-1px); }

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

.sc-btn-ghost:hover { color: var(--text); }

.sc-btn-danger {
  color: #fff;
  background: linear-gradient(135deg, var(--rose), #fb7185);
  box-shadow: 0 12px 28px rgba(225,29,72,.18);
}

.sc-members-wrap { padding: 10px 14px 14px; }

.sc-member-row {
  display: grid;
  grid-template-columns: minmax(0, 1.2fr) 160px 170px 54px 54px;
  align-items: center;
  gap: 10px;
  padding: 14px 12px;
  border-bottom: 1px solid var(--line);
  border-radius: 16px;
  transition: background .16s ease, transform .16s ease;
}

.sc-member-row:hover { background: rgba(37,99,235,.04); }

.sc-member-row:last-child { border-bottom: none; }

@media (max-width: 920px) {
  .sc-member-row { grid-template-columns: 1fr; gap: 8px; }
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

.sc-person-copy { min-width: 0; }

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
  border-color: rgba(37,99,235,.18);
  background: var(--blue-soft);
  color: var(--blue);
}

.sc-icon-btn.danger:hover {
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
  flex-wrap: wrap;
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

.sc-team-member:first-child { border-top: none; }

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

.sc-modal.lg { max-width: 760px; }
.sc-modal.sm { max-width: 400px; }

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

.sc-modal-body { padding: 18px 20px; }

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
  .sc-grid-2 { grid-template-columns: 1fr; }
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

.sc-field label span { color: var(--rose); }

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

.sc-input::placeholder { color: var(--text-3); }

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
  .sc-inline-stat { grid-template-columns: repeat(2, minmax(0,1fr)); }
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

.sc-assign-list {
  max-height: 380px;
  overflow-y: auto;
}

.sc-assign-item {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 12px 0;
  border-bottom: 1px solid var(--line);
}

.sc-assign-item:last-child { border-bottom: none; }

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

.sc-toast.ok { background: linear-gradient(135deg, var(--green), #34d399); }
.sc-toast.err { background: linear-gradient(135deg, var(--rose), #fb7185); }
</style>
@endpush

<div class="col-span-full">
  <div class="sc-shell">

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
          <p>Manage members, teams, and team assignments in one place. One member can belong to multiple teams, and team details can be edited anytime.</p>
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
            <div class="sc-member-row"
                 id="row-{{ $member->id }}"
                 data-role="{{ $member->subcon_role }}"
                 data-name="{{ $member->name }}"
                 data-email="{{ $member->email }}"
                 data-phone="{{ $member->contact_number ?? '' }}"
                 data-roleval="{{ $member->subcon_role }}">
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
                <button class="sc-icon-btn edit-member"
                  type="button"
                  data-id="{{ $member->id }}"
                  title="Edit member">
                  <i class="mgc_edit_2_line"></i>
                </button>
              </div>

              <div style="text-align:right;">
                <button class="sc-icon-btn danger remove-member"
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

                  <button class="sc-icon-btn edit-team-btn"
                    type="button"
                    data-id="{{ $team->id }}"
                    data-name="{{ $team->team_name }}"
                    title="Edit team">
                    <i class="mgc_edit_2_line"></i>
                  </button>

                  <button class="sc-icon-btn danger del-team-btn"
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
                      <span data-role-holder>
                        @if($member->subcon_role === 'pm')
                          <span class="sc-badge pm"><i class="mgc_briefcase_line"></i> PM</span>
                        @else
                          <span class="sc-badge lineman"><i class="mgc_tool_line"></i> Lineman</span>
                        @endif
                      </span>
                    </div>

                    <button class="sc-icon-btn sm danger remove-team-member"
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

<div id="addOv" class="sc-ov">
  <div class="sc-modal">
    <div class="sc-modal-head">
      <div class="sc-modal-icon blue"><i class="mgc_user_add_line"></i></div>
      <div>
        <div class="sc-modal-title">Add Member</div>
        <div class="sc-modal-sub">Add a new subcontractor member.</div>
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
            <label for="mContact">Contact Number</label>
            <input id="mContact" name="contact_number" class="sc-input" type="text" placeholder="e.g. 0917-xxx-xxxx" value="{{ old('contact_number') }}">
          </div>

          <div class="sc-field">
            <label for="mRole">Role <span>*</span></label>
            <select id="mRole" name="subcon_role" class="sc-input" required>
              <option value="" disabled {{ old('subcon_role') ? '' : 'selected' }}>Select role…</option>
              <option value="pm" {{ old('subcon_role') === 'pm' ? 'selected' : '' }}>Project Manager</option>
              <option value="lineman" {{ old('subcon_role') === 'lineman' ? 'selected' : '' }}>Lineman</option>
            </select>
            @error('subcon_role') <div class="sc-err">{{ $message }}</div> @enderror
          </div>
        </div>

        <div class="sc-field">
          <label for="mPassword">Password <span>*</span></label>
          <input id="mPassword" name="password" class="sc-input" type="password" placeholder="Minimum 8 characters" required>
          @error('password') <div class="sc-err">{{ $message }}</div> @enderror
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

<div id="editMemberOv" class="sc-ov">
  <div class="sc-modal">
    <div class="sc-modal-head">
      <div class="sc-modal-icon blue"><i class="mgc_edit_2_line"></i></div>
      <div>
        <div class="sc-modal-title">Edit Member</div>
        <div class="sc-modal-sub">Update member details and role.</div>
      </div>
      <button class="sc-modal-close" id="btnCloseEditMember" type="button"><i class="mgc_close_line"></i></button>
    </div>

    <div class="sc-modal-body">
      <form id="editMemberForm" class="sc-form" novalidate>
        <input type="hidden" id="emId">

        <div class="sc-grid-2">
          <div class="sc-field">
            <label for="emName">Full Name <span>*</span></label>
            <input id="emName" class="sc-input" type="text" placeholder="e.g. Juan dela Cruz">
            <div id="emNameErr" class="sc-err" style="display:none;"></div>
          </div>

          <div class="sc-field">
            <label for="emEmail">Email <span>*</span></label>
            <input id="emEmail" class="sc-input" type="email" placeholder="e.g. juan@subcon.com">
            <div id="emEmailErr" class="sc-err" style="display:none;"></div>
          </div>
        </div>

        <div class="sc-grid-2">
          <div class="sc-field">
            <label for="emContact">Contact Number</label>
            <input id="emContact" class="sc-input" type="text" placeholder="e.g. 0917-xxx-xxxx">
          </div>

          <div class="sc-field">
            <label for="emRole">Role <span>*</span></label>
            <select id="emRole" class="sc-input">
              <option value="pm">Project Manager</option>
              <option value="lineman">Lineman</option>
            </select>
          </div>
        </div>

        <div class="sc-field">
          <label for="emPassword">New Password</label>
          <input id="emPassword" class="sc-input" type="password" placeholder="Leave blank to keep current password">
        </div>
      </form>
    </div>

    <div class="sc-modal-foot">
      <button class="sc-btn sc-btn-ghost" id="btnCancelEditMember" type="button">Cancel</button>
      <button class="sc-btn sc-btn-blue" id="btnUpdateMember" type="button">
        <i class="mgc_save_line"></i>
        Save Changes
      </button>
    </div>
  </div>
</div>

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

<div id="addTeamOv" class="sc-ov">
  <div class="sc-modal sm">
    <div class="sc-modal-head">
      <div class="sc-modal-icon violet"><i class="mgc_group_line"></i></div>
      <div>
        <div class="sc-modal-title">Create Team</div>
        <div class="sc-modal-sub">Create a new team for this subcontractor.</div>
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

<div id="editTeamOv" class="sc-ov">
  <div class="sc-modal sm">
    <div class="sc-modal-head">
      <div class="sc-modal-icon blue"><i class="mgc_edit_2_line"></i></div>
      <div>
        <div class="sc-modal-title">Edit Team</div>
        <div class="sc-modal-sub">Update team name and details.</div>
      </div>
      <button class="sc-modal-close" id="btnCloseEditTeam" type="button"><i class="mgc_close_line"></i></button>
    </div>

    <div class="sc-modal-body">
      <div class="sc-field">
        <label for="eTeamName">Team Name <span>*</span></label>
        <input id="eTeamName" class="sc-input" type="text" placeholder="e.g. Alpha Team">
        <div id="eTeamErr" class="sc-err" style="display:none;"></div>
      </div>
    </div>

    <div class="sc-modal-foot">
      <button class="sc-btn sc-btn-ghost" id="btnCancelEditTeam" type="button">Cancel</button>
      <button class="sc-btn sc-btn-blue" id="btnUpdateTeam" type="button">
        <i class="mgc_save_line"></i>
        Save Changes
      </button>
    </div>
  </div>
</div>

<div id="assignOv" class="sc-ov">
  <div class="sc-modal lg">
    <div class="sc-modal-head">
      <div class="sc-modal-icon violet"><i class="mgc_user_add_line"></i></div>
      <div>
        <div class="sc-modal-title">Assign Members</div>
        <div class="sc-modal-sub" id="assignSubtitle">Assign members to this team</div>
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

<div id="delTeamOv" class="sc-ov">
  <div class="sc-modal sm">
    <div class="sc-modal-head">
      <div class="sc-modal-icon rose"><i class="mgc_delete_2_line"></i></div>
      <div>
        <div class="sc-modal-title">Delete Team?</div>
        <div class="sc-modal-sub" id="delTeamMsg">All memberships under this team will be removed.</div>
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

<div id="scToast" class="sc-toast">
  <i id="scToastIco"></i>
  <span id="scToastMsg"></span>
</div>

@php
  $teamMembersMap = $teams->mapWithKeys(function ($team) {
      return [
          $team->id => $team->members->map(function ($m) {
              return [
                  'id' => $m->id,
                  'name' => $m->name,
                  'email' => $m->email,
                  'subcon_role' => $m->subcon_role,
                  'contact_number' => $m->contact_number ?? null,
              ];
          })->values()->toArray(),
      ];
  })->toArray();

  $allMembersData = $members->map(function ($m) {
      return [
          'id' => $m->id,
          'name' => $m->name,
          'email' => $m->email,
          'subcon_role' => $m->subcon_role,
          'contact_number' => $m->contact_number ?? null,
      ];
  })->values()->toArray();
@endphp

@push('scripts')
<script>
(function(){
  const CSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  const teamMembersMap = @json($teamMembersMap);
  const allMembers = @json($allMembersData);

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
    if(!el) return;
    el.classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function closeModal(el){
    if(!el) return;
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

    const statMembers = document.getElementById('statMembers');
    const statPm = document.getElementById('statPm');
    const statLineman = document.getElementById('statLineman');
    const statTeams = document.getElementById('statTeams');

    if(statMembers) statMembers.textContent = total;
    if(statPm) statPm.textContent = pm;
    if(statLineman) statLineman.textContent = lineman;
    if(statTeams) statTeams.textContent = document.querySelectorAll('.sc-team').length;
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

  function removeNoMembersLabel(teamId){
    const el = document.querySelector(`.team-members-${teamId} .sc-team-no`);
    if(el) el.remove();
  }

  const addOv = document.getElementById('addOv');
  const addForm = document.getElementById('addForm');

  const btnAddMember = document.getElementById('btnAddMember');
  if(btnAddMember) btnAddMember.onclick = () => openModal(addOv);

  ['btnCloseAdd','btnCancelAdd'].forEach(id => {
    const el = document.getElementById(id);
    if(el) el.onclick = () => closeModal(addOv);
  });

  if(addOv){
    addOv.addEventListener('click', e => {
      if(e.target === addOv) closeModal(addOv);
    });
  }

  const btnSaveMember = document.getElementById('btnSaveMember');
  if(btnSaveMember && addForm) btnSaveMember.onclick = () => addForm.submit();

  @if($errors->any())
    openModal(addOv);
  @endif

  const editMemberOv = document.getElementById('editMemberOv');
  let activeEditMemberId = null;

  function clearEditMemberErrors(){
    ['emNameErr','emEmailErr'].forEach(id => {
      const el = document.getElementById(id);
      if(el){
        el.textContent = '';
        el.style.display = 'none';
      }
    });
  }

  function openEditMember(id){
    const row = document.getElementById(`row-${id}`);
    if(!row) return;

    activeEditMemberId = id;
    document.getElementById('emId').value = id;
    document.getElementById('emName').value = row.dataset.name || '';
    document.getElementById('emEmail').value = row.dataset.email || '';
    document.getElementById('emContact').value = row.dataset.phone || '';
    document.getElementById('emRole').value = row.dataset.roleval || 'lineman';
    document.getElementById('emPassword').value = '';
    clearEditMemberErrors();
    openModal(editMemberOv);
  }

  function closeEditMember(){
    closeModal(editMemberOv);
    activeEditMemberId = null;
  }

  ['btnCloseEditMember','btnCancelEditMember'].forEach(id => {
    const el = document.getElementById(id);
    if(el) el.onclick = closeEditMember;
  });

  if(editMemberOv){
    editMemberOv.addEventListener('click', e => {
      if(e.target === editMemberOv) closeEditMember();
    });
  }

  const btnUpdateMember = document.getElementById('btnUpdateMember');
  if(btnUpdateMember){
    btnUpdateMember.addEventListener('click', async () => {
      if(!activeEditMemberId) return;

      clearEditMemberErrors();

      const payload = {
        name: document.getElementById('emName').value.trim(),
        email: document.getElementById('emEmail').value.trim(),
        contact_number: document.getElementById('emContact').value.trim(),
        subcon_role: document.getElementById('emRole').value,
        password: document.getElementById('emPassword').value
      };

      if(!payload.name){
        const el = document.getElementById('emNameErr');
        if(el){
          el.textContent = 'Name is required.';
          el.style.display = 'block';
        }
        return;
      }

      if(!payload.email){
        const el = document.getElementById('emEmailErr');
        if(el){
          el.textContent = 'Email is required.';
          el.style.display = 'block';
        }
        return;
      }

      btnUpdateMember.disabled = true;

      try {
        const res = await fetch(`{{ url('admin/subcons/members') }}/${activeEditMemberId}`, {
          method: 'PUT',
          headers: {
            'X-CSRF-TOKEN': CSRF,
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify(payload)
        });

        const data = await res.json();

        if(!res.ok || !data.success){
          if(data.errors){
            if(data.errors.name){
              const el = document.getElementById('emNameErr');
              if(el){
                el.textContent = data.errors.name[0];
                el.style.display = 'block';
              }
            }
            if(data.errors.email){
              const el = document.getElementById('emEmailErr');
              if(el){
                el.textContent = data.errors.email[0];
                el.style.display = 'block';
              }
            }
          } else {
            toast(data.message || 'Failed to update member.', false);
          }
          return;
        }

        const user = data.user;
        const row = document.getElementById(`row-${user.id}`);
        if(row){
          row.dataset.name = user.name;
          row.dataset.email = user.email;
          row.dataset.phone = user.contact_number || '';
          row.dataset.role = user.subcon_role;
          row.dataset.roleval = user.subcon_role;

          const avatar = row.querySelector('.sc-avatar');
          const nameEl = row.querySelector('.sc-person-name');
          const mailEl = row.querySelector('.sc-person-mail');
          const removeBtn = row.querySelector('.remove-member');

          if(avatar) avatar.textContent = initialLetters(user.name);
          if(nameEl) nameEl.textContent = user.name;
          if(mailEl) mailEl.textContent = user.email;
          if(removeBtn) removeBtn.dataset.name = user.name;

          const badgeWrap = row.children[1];
          if(badgeWrap){
            badgeWrap.innerHTML = user.subcon_role === 'pm'
              ? `<span class="sc-badge pm"><i class="mgc_briefcase_line"></i> Project Manager</span>`
              : `<span class="sc-badge lineman"><i class="mgc_tool_line"></i> Lineman</span>`;
          }
        }

        Object.keys(teamMembersMap).forEach(teamId => {
          teamMembersMap[teamId] = (teamMembersMap[teamId] || []).map(m => {
            if(String(m.id) === String(user.id)) return user;
            return m;
          });

          const teamRow = document.getElementById(`tm-${teamId}-${user.id}`);
          if(teamRow){
            const avatar = teamRow.querySelector('.sc-team-avatar');
            const nameEl = teamRow.querySelector('.sc-team-member-name');
            const badgeHolder = teamRow.querySelector('[data-role-holder]');
            const removeBtn = teamRow.querySelector('.remove-team-member');

            if(avatar) avatar.textContent = initialLetters(user.name);
            if(nameEl) nameEl.textContent = user.name;
            if(badgeHolder) badgeHolder.innerHTML = roleBadge(user.subcon_role, true);
            if(removeBtn) removeBtn.dataset.name = user.name;
          }
        });

        updateTopStats();
        closeEditMember();
        toast('Member updated.');
      } catch (e) {
        toast('Network error.', false);
      } finally {
        btnUpdateMember.disabled = false;
      }
    });
  }

  function bindEditMemberButtons(scope = document){
    scope.querySelectorAll('.edit-member').forEach(btn => {
      btn.onclick = () => openEditMember(btn.dataset.id);
    });
  }

  bindEditMemberButtons();

  const delOv = document.getElementById('delOv');
  let pendingDelId = null;
  let pendingDelUrl = null;

  function openDel(id, name, url){
    pendingDelId = id;
    pendingDelUrl = url;
    const msg = document.getElementById('delMsg');
    if(msg) msg.textContent = `Remove "${name}" from this subcontractor?`;
    openModal(delOv);
  }

  function closeDel(){
    closeModal(delOv);
    pendingDelId = null;
    pendingDelUrl = null;
  }

  ['btnDelCancel','btnDelClose'].forEach(id => {
    const el = document.getElementById(id);
    if(el) el.onclick = closeDel;
  });

  if(delOv){
    delOv.addEventListener('click', e => {
      if(e.target === delOv) closeDel();
    });
  }

  const btnDelConfirm = document.getElementById('btnDelConfirm');
  if(btnDelConfirm){
    btnDelConfirm.addEventListener('click', async () => {
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

        Object.keys(teamMembersMap).forEach(teamId => {
          teamMembersMap[teamId] = (teamMembersMap[teamId] || []).filter(x => String(x.id) !== String(pendingDelId));
          document.getElementById(`tm-${teamId}-${pendingDelId}`)?.remove();
          updateTeamCount(teamId);
          ensureNoMembersLabel(teamId);
        });

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
  }

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

  const addTeamOv = document.getElementById('addTeamOv');

  const btnAddTeam = document.getElementById('btnAddTeam');
  if(btnAddTeam) btnAddTeam.onclick = () => openModal(addTeamOv);

  ['btnCloseAddTeam','btnCancelAddTeam'].forEach(id => {
    const el = document.getElementById(id);
    if(el){
      el.onclick = () => {
        closeModal(addTeamOv);
        document.getElementById('tTeamName').value = '';
        document.getElementById('tTeamErr').style.display = 'none';
      };
    }
  });

  if(addTeamOv){
    addTeamOv.addEventListener('click', e => {
      if(e.target === addTeamOv) closeModal(addTeamOv);
    });
  }

  const btnSaveTeam = document.getElementById('btnSaveTeam');
  if(btnSaveTeam){
    btnSaveTeam.addEventListener('click', async () => {
      const name = document.getElementById('tTeamName').value.trim();
      const errEl = document.getElementById('tTeamErr');

      if(!name){
        errEl.textContent = 'Team name is required.';
        errEl.style.display = 'block';
        return;
      }

      errEl.style.display = 'none';
      btnSaveTeam.disabled = true;

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
        teamMembersMap[t.id] = [];

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
              <button class="sc-icon-btn edit-team-btn" type="button" data-id="${t.id}" data-name="${t.team_name}" title="Edit team">
                <i class="mgc_edit_2_line"></i>
              </button>
              <button class="sc-icon-btn danger del-team-btn" type="button" data-id="${t.id}" data-name="${t.team_name}" title="Delete team">
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
        btnSaveTeam.disabled = false;
      }
    });
  }

  const editTeamOv = document.getElementById('editTeamOv');
  let activeEditTeamId = null;

  function openEditTeam(id, name){
    activeEditTeamId = id;
    document.getElementById('eTeamName').value = name || '';
    document.getElementById('eTeamErr').style.display = 'none';
    openModal(editTeamOv);
  }

  function closeEditTeam(){
    closeModal(editTeamOv);
    activeEditTeamId = null;
  }

  ['btnCloseEditTeam','btnCancelEditTeam'].forEach(id => {
    const el = document.getElementById(id);
    if(el) el.onclick = closeEditTeam;
  });

  if(editTeamOv){
    editTeamOv.addEventListener('click', e => {
      if(e.target === editTeamOv) closeEditTeam();
    });
  }

  const btnUpdateTeam = document.getElementById('btnUpdateTeam');
  if(btnUpdateTeam){
    btnUpdateTeam.addEventListener('click', async () => {
      const name = document.getElementById('eTeamName').value.trim();
      const errEl = document.getElementById('eTeamErr');

      if(!name){
        errEl.textContent = 'Team name is required.';
        errEl.style.display = 'block';
        return;
      }

      errEl.style.display = 'none';
      btnUpdateTeam.disabled = true;

      try {
        const res = await fetch(`{{ url('admin/subcons/teams') }}/${activeEditTeamId}`, {
          method: 'PUT',
          headers: {
            'X-CSRF-TOKEN': CSRF,
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify({ team_name: name })
        });

        const data = await res.json();

        if(!res.ok || !data.success){
          errEl.textContent = data.message || 'Failed to update team.';
          errEl.style.display = 'block';
          return;
        }

        const card = document.getElementById(`tc-${activeEditTeamId}`);
        if(card){
          card.querySelector('.sc-team-name').textContent = data.team.team_name;
          const assignBtn = card.querySelector('.assign-team-btn');
          const editBtn = card.querySelector('.edit-team-btn');
          const delBtn = card.querySelector('.del-team-btn');
          if(assignBtn) assignBtn.dataset.name = data.team.team_name;
          if(editBtn) editBtn.dataset.name = data.team.team_name;
          if(delBtn) delBtn.dataset.name = data.team.team_name;
        }

        closeEditTeam();
        toast('Team updated.');
      } catch (e) {
        errEl.textContent = 'Network error.';
        errEl.style.display = 'block';
      } finally {
        btnUpdateTeam.disabled = false;
      }
    });
  }

  const assignOv = document.getElementById('assignOv');
  let activeTeamId = null;
  let activeTeamName = null;

  function openAssign(id, name){
    activeTeamId = String(id);
    activeTeamName = name;
    document.getElementById('assignSubtitle').textContent = `Assign members to "${name}"`;
    openModal(assignOv);
    renderAssignList();
  }

  function closeAssign(){
    closeModal(assignOv);
    activeTeamId = null;
    activeTeamName = null;
  }

  ['btnCloseAssign','btnCancelAssign'].forEach(id => {
    const el = document.getElementById(id);
    if(el) el.onclick = closeAssign;
  });

  if(assignOv){
    assignOv.addEventListener('click', e => {
      if(e.target === assignOv) closeAssign();
    });
  }

  function renderAssignList(){
    const list = document.getElementById('assignList');
    const assignedIds = new Set((teamMembersMap[activeTeamId] || []).map(x => String(x.id)));
    const assignable = allMembers.filter(u => !assignedIds.has(String(u.id)));

    if(!assignable.length){
      list.innerHTML = `<div style="color:var(--text-3);font-family:var(--fm);font-size:12px;text-align:center;padding:24px 0;">All available members are already in this team.</div>`;
      return;
    }

    list.innerHTML = assignable.map(u => `
      <div class="sc-assign-item" id="al-${u.id}">
        <div class="sc-avatar">${initialLetters(u.name)}</div>
        <div style="flex:1;min-width:0;">
          <div class="sc-person-name">${u.name}</div>
          <div class="sc-person-mail">${u.email || (u.subcon_role === 'pm' ? 'Project Manager' : 'Lineman')}</div>
        </div>
        <div>${roleBadge(u.subcon_role, true)}</div>
        <button class="sc-btn sc-btn-violet do-assign-btn"
          type="button"
          data-uid="${u.id}"
          style="padding:7px 12px;font-size:11px;">
          <i class="mgc_user_add_line"></i>
          Add
        </button>
      </div>
    `).join('');

    list.querySelectorAll('.do-assign-btn').forEach(btn => {
      btn.addEventListener('click', async () => {
        const uid = btn.dataset.uid;
        const user = allMembers.find(x => String(x.id) === String(uid));
        if(!user) return;

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
            toast(data.message || 'Failed to assign.', false);
            btn.disabled = false;
            btn.innerHTML = '<i class="mgc_user_add_line"></i> Add';
            return;
          }

          if(!teamMembersMap[activeTeamId]) teamMembersMap[activeTeamId] = [];
          if(!teamMembersMap[activeTeamId].find(x => String(x.id) === String(uid))){
            teamMembersMap[activeTeamId].push(user);
          }

          const body = document.querySelector(`.team-members-${activeTeamId}`);
          if(body){
            removeNoMembersLabel(activeTeamId);

            const exists = document.getElementById(`tm-${activeTeamId}-${uid}`);
            if(!exists){
              const row = document.createElement('div');
              row.className = 'sc-team-member';
              row.id = `tm-${activeTeamId}-${uid}`;
              row.innerHTML = `
                <div class="sc-team-avatar">${initialLetters(user.name)}</div>
                <div style="flex:1;display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
                  <span class="sc-team-member-name">${user.name}</span>
                  <span data-role-holder>${roleBadge(user.subcon_role, true)}</span>
                </div>
                <button class="sc-icon-btn sm danger remove-team-member"
                  type="button"
                  data-team="${activeTeamId}"
                  data-user="${uid}"
                  data-name="${user.name}"
                  title="Remove from team">
                  <i class="mgc_close_line"></i>
                </button>
              `;
              body.appendChild(row);
              bindRemoveTeamMember(row.querySelector('.remove-team-member'));
            }
          }

          updateTeamCount(activeTeamId);
          renderAssignList();
          toast(`${user.name} assigned to ${activeTeamName}.`);
        } catch (e) {
          toast('Network error.', false);
          btn.disabled = false;
          btn.innerHTML = '<i class="mgc_user_add_line"></i> Add';
        }
      });
    });
  }

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
          toast(data.message || 'Failed to remove.', false);
          return;
        }

        document.getElementById(`tm-${tid}-${uid}`)?.remove();
        teamMembersMap[tid] = (teamMembersMap[tid] || []).filter(x => String(x.id) !== String(uid));
        updateTeamCount(tid);
        ensureNoMembersLabel(tid);

        if(activeTeamId && String(activeTeamId) === String(tid)){
          renderAssignList();
        }

        toast(`${name} removed from team.`);
      } catch (e) {
        toast('Network error.', false);
      }
    });
  }

  document.querySelectorAll('.remove-team-member').forEach(btn => bindRemoveTeamMember(btn));

  const delTeamOv = document.getElementById('delTeamOv');
  let pendingDelTeamId = null;

  function openDelTeam(id, name){
    pendingDelTeamId = id;
    const msg = document.getElementById('delTeamMsg');
    if(msg) msg.textContent = `Delete team "${name}"? All memberships under this team will be removed.`;
    openModal(delTeamOv);
  }

  function closeDelTeam(){
    closeModal(delTeamOv);
    pendingDelTeamId = null;
  }

  ['btnDelTeamCancel','btnDelTeamClose'].forEach(id => {
    const el = document.getElementById(id);
    if(el) el.onclick = closeDelTeam;
  });

  if(delTeamOv){
    delTeamOv.addEventListener('click', e => {
      if(e.target === delTeamOv) closeDelTeam();
    });
  }

  const btnDelTeamConfirm = document.getElementById('btnDelTeamConfirm');
  if(btnDelTeamConfirm){
    btnDelTeamConfirm.addEventListener('click', async () => {
      if(!pendingDelTeamId) return;

      btnDelTeamConfirm.disabled = true;

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
          toast(data.message || 'Failed to delete team.', false);
          return;
        }

        delete teamMembersMap[pendingDelTeamId];
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
        btnDelTeamConfirm.disabled = false;
      }
    });
  }

  function bindTeamButtons(scope){
    scope.querySelectorAll('.assign-team-btn').forEach(btn => {
      btn.onclick = () => openAssign(btn.dataset.id, btn.dataset.name);
    });

    scope.querySelectorAll('.edit-team-btn').forEach(btn => {
      btn.onclick = () => openEditTeam(btn.dataset.id, btn.dataset.name);
    });

    scope.querySelectorAll('.del-team-btn').forEach(btn => {
      btn.onclick = () => openDelTeam(btn.dataset.id, btn.dataset.name);
    });
  }

  document.querySelectorAll('.sc-team').forEach(team => bindTeamButtons(team));

  document.addEventListener('keydown', e => {
    if(e.key !== 'Escape') return;
    const modals = [addOv, editMemberOv, delOv, addTeamOv, editTeamOv, assignOv, delTeamOv];
    const openOne = modals.find(m => m.classList.contains('open'));
    if(openOne){
      openOne.classList.remove('open');
      document.body.style.overflow = '';
    }
  });

  @if(session('success'))
    toast(@json(session('success')));
  @endif

  updateTopStats();
})();
</script>
@endpush
</x-layout>