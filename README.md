# DVWA Web Security Lab

## Purpose
This repository holds **defensive code patches** for a lab that studies common web application vulnerabilities using DVWA (Damn Vulnerable Web Application). The provided code demonstrates practical fixes and mitigations you can apply to DVWA to harden it against typical issues found in LAMP web apps.

## Basic description of the experiment
The experiment’s goal is to *identify, reproduce (in an isolated lab), and mitigate* web vulnerabilities. Typical workflow for each vulnerability in the lab:

1. **Baseline** — Deploy DVWA in an isolated VM and capture baseline evidence (login screen, Create/Reset DB, security level).
2. **Reproduce (lab-only)** — On your isolated VM, reproduce the vulnerability to gather proof (screenshots/video). Do not perform tests on systems you do not own or explicitly have permission to test.
3. **Mitigate** — Apply the defensive patch from this repository.
4. **Verify** — Re-run the same test in the lab and capture evidence showing the vulnerability has been mitigated.
5. **Report** — Compile screenshots, commands, explanation, and a CVSS-like risk rating into the final PDF.

## What each code file is used for
- `patches/sql_fix.php`  
  Implements use of PDO prepared statements and secure password verification to prevent SQL injection and strengthen authentication checks.

- `patches/xss_fix.php`  
  Provides a small helper that performs proper HTML output encoding to prevent reflected and stored XSS when rendering user-supplied data.

- `patches/csrf_fix.php`  
  Adds CSRF token generation, form integration, and request validation to protect state-changing endpoints from cross-site request forgery.

- `patches/upload_fix.php`  
  Demonstrates secure file upload handling: MIME/type and extension validation, size limits, storage outside the webroot, and safe filename generation to reduce file upload abuse and remote code execution risks.

- `patches/rate_limit.php`  
  A minimal rate-limiter for authentication endpoints to slow down brute-force attempts; intended as an example to be replaced by a robust store-backed limiter in production.

- `patches/.htaccess_upload_block`  
  Apache configuration fragment that prevents execution of uploaded scripts in the upload directory and disables PHP handlers for that location.

## How to use the code in the experiment (high-level)
1. Install DVWA in an isolated VM and take baseline screenshots.
2. Place the relevant patch files into DVWA’s codebase (keep backups of original files).
3. Apply a patch and restart the web server if necessary.
4. Verify the behavior change by attempting the same lab tests within your isolated environment and capture before/after screenshots.
5. Document the steps and include the defensive code snippets in your report.

## Safety & ethics
- Only perform exploit/reproduction steps on machines you own or have explicit permission to test (use an isolated lab VM and snapshots).
- This repository intentionally contains **only defensive code** and documentation. It does not include exploit payloads, web shells, or instructions for attacking third-party systems.

## Submission checklist
- Final PDF report with executive summary, evidence, remediation notes, and risk ratings.
- Evidence folder containing labeled screenshots and any optional videos.
- This repository (defensive patches).
