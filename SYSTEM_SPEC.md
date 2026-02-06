# MockPay SaaS - Roles, Features, and Workflow Specification

MockPay is a SaaS **dummy payment gateway simulator** designed to help developers and companies test payment integration logic without real money.

This document defines:
- Core roles (Platform, Tenant, Guest)
- Responsibilities and feature boundaries
- End-to-end workflow
- Manual override simulation model
- Transaction testing result export/download feature

---

## Core Principles (Non-Negotiable)

✅ Tenant self-managed  
✅ Admin platform does not have access to tenant operational data  
✅ Manual override is performed only by tenant  

MockPay is not a "payment gateway operator" like Midtrans.
MockPay is a "simulation platform" where tenants manage their own testing lifecycle.

---

# 1) Role Definitions

## 1.1 Platform (MockPay Owner / System Operator)

Platform is the service provider.
Platform manages the SaaS infrastructure and tenant lifecycle only.

Platform is NOT allowed to interfere with tenant transactions or tenant payment simulation decisions.

---

## 1.2 Tenant (User / Client / Customer of SaaS)

Tenant is the primary user of MockPay.

Tenant represents a company/developer team building a payment integration system.
Tenant is responsible for their own API keys, webhooks, transactions, and simulation results.

Tenant controls all transaction outcomes through manual override.

---

## 1.3 Guest (End User / Payer / Customer Simulation)

Guest is the simulated payer.

Guest does not have an account.
Guest interacts only with a hosted payment page if tenant chooses to use it.

Guest cannot access dashboard, API keys, webhooks, or logs.

---

# 2) Feature Matrix

| Feature | Platform Admin | Tenant | Guest |
|--------|----------------|--------|-------|
| Tenant registration/login | ❌ | ✅ | ❌ |
| Manage own API keys | ❌ | ✅ | ❌ |
| Configure webhook URL | ❌ | ✅ | ❌ |
| View own transactions | ❌ | ✅ | ❌ |
| Manual override transaction outcome | ❌ | ✅ | ❌ |
| Trigger resend webhook | ❌ | ✅ | ❌ |
| View webhook delivery logs | ❌ | ✅ | ❌ |
| Download transaction test results | ❌ | ✅ | ❌ |
| Download payment result receipt (PDF/JSON) | ❌ | ✅ | ❌ |
| Access hosted payment page | ❌ | ❌ | ✅ |
| Create transactions via API | ❌ | ✅ | ❌ |
| Suspend tenant account | ✅ | ❌ | ❌ |
| Manage SaaS plans | ✅ | ❌ | ❌ |
| View global health/statistics | ✅ | ❌ | ❌ |

---

# 3) Platform Features (MockPay Owner)

Platform features are limited to infrastructure-level control and tenant lifecycle.

Platform MUST NOT be able to:
- override tenant transactions
- modify tenant webhook URL
- view tenant API keys
- view tenant webhook payload details
- view tenant customer data (PII)

---

## 3.1 Tenant Management
Platform can:
- list tenants
- suspend / activate tenants
- view tenant plan (Free/Pro)
- view tenant creation date and status
- set plan level (Free/Pro/Enterprise)
- handle support requests at metadata-level

Allowed metadata view:
- tenant id
- tenant email
- tenant status
- tenant plan
- tenant usage summary (counts only)

---

## 3.2 Global Configuration
Platform can manage:
- global payment channel availability (BCA VA, GoPay, QRIS, etc.)
- default fee rules (global baseline)
- system-wide rate limit baseline
- service uptime monitoring
- queue/webhook worker monitoring

---

## 3.3 Billing / Donation Upgrade
Platform manages donation-based upgrades:
- donation payment history
- upgrade status tracking
- plan activation duration (optional)

Platform does not override transaction data.
Platform only controls plan entitlement.

---

# 4) Tenant Features (Self-Service Dashboard)

Tenant is the only actor allowed to manage and override their own transaction simulation lifecycle.

Tenant dashboard is the primary product of MockPay.

---

## 4.1 Authentication & Account
Tenant can:
- register account
- verify email
- login/logout
- reset password
- update profile and organization settings

Optional:
- team members (Pro)
- role-based access control inside tenant (Pro)

---

## 4.2 API Keys Management
Tenant can:
- generate API keys
- rotate keys
- revoke keys
- manage sandbox/production keys separately
- name keys (for teams)
- track last used timestamp
- set expiry date (optional)

Key usage is isolated per tenant.

---

## 4.3 Webhook Management
Tenant can:
- set webhook URL
- generate webhook secret
- test webhook delivery with sample payload
- enable/disable webhook event types
- view delivery logs
- retry failed webhooks manually
- view signature generation rules

Webhook delivery must support:
- queued async delivery
- retry strategy
- delivery log storage
- signature header validation support

---

## 4.4 Transaction Management
Tenant can:
- view list of transactions
- filter transactions by:
  - status
  - payment method
  - date range
  - order_id / transaction_id search
- view transaction detail
- view transaction timeline
- view customer metadata (only within tenant scope)
- export transactions (CSV/Excel)

Transaction detail must show:
- transaction_id
- order_id
- amount / fee / total_amount
- status timeline
- payment method info
- metadata payload
- webhook delivery history

---

## 4.5 Manual Override (Core Feature)
Manual override is the key simulation feature.

Tenant can manually control the payment result at any time.

Manual override actions:
- Approve / Success (settlement)
- Reject / Failed
- Expire
- Cancel
- Refund (full)
- Refund (partial)

Manual override must enforce safe status transitions:
- pending -> settlement / failed / expire / cancel
- settlement -> refund / partial_refund
- failed/expire/cancel -> final (cannot become settlement)

Each override must record:
- who triggered the override (tenant user)
- override timestamp
- reason (optional)
- resulting status
- payload snapshot for test history

---

## 4.6 Simulation Result Logs (Testing Evidence)
Every manual override must generate a "simulation result log".

This is the main value of MockPay as a testing platform.

Simulation log should include:
- transaction_id
- previous_status
- new_status
- override_reason
- triggered_by
- webhook_attempt_summary
- webhook_response_code
- webhook_response_body
- webhook_sent_at
- generated signature (optional masked)
- payment method details (VA number, QR string, card outcome)

---

## 4.7 Download Transaction Result (Required Feature)
Tenant must be able to download transaction testing results.

Download formats:
- JSON (raw webhook payload + metadata)
- PDF receipt (human readable)
- CSV export (bulk)

Download options:
- Download single transaction test result
- Download filtered report (date range + status)
- Download webhook log report

Download content example (single transaction):
- transaction details
- payment method simulation result
- override timeline
- webhook payload sent
- webhook response received
- retry history
- final status confirmation

This acts as:
- audit log
- integration testing proof
- documentation for tenant development team

---

## 4.8 Developer Tools (Tenant-Only)
Tenant has access to:
- API docs (Swagger UI)
- integration examples (PHP/Node/Python/Go/cURL)
- webhook signature verification examples
- test cards list
- sample payload generator
- quick transaction generator

Developer tools must always display:
- tenant sandbox keys
- tenant production keys
- tenant-specific webhook secret usage examples

---

## 4.9 Rate Limit and Usage Monitoring
Tenant can view:
- API request logs
- rate limit usage
- last request timestamp
- error logs related to their own requests

---

## 4.10 Donation-Based Upgrade (Pro Unlock)
Tenant can upgrade to Pro via donation.

Tenant upgrade page should include:
- donation tiers
- unlock benefits
- plan activation status
- expiration date (if time-based)
- donation history

Pro feature unlock examples:
- higher API rate limits
- team members
- advanced analytics
- bulk download report
- longer log retention

---

# 5) Guest Features (Hosted Payment Page)

Guest is only relevant if tenant uses MockPay hosted payment page template.

Guest does not login.

Guest is never able to:
- access tenant dashboard
- view other transactions
- access API keys
- access webhook logs

---

## 5.1 Hosted Payment Page
Guest can access:
- `/payment/{transaction_id}`

The payment page is provided as a template UI.

Hosted payment page features:
- show merchant/tenant branding
- show amount + order info
- select payment method
- display instructions (VA steps, QR scan, etc.)
- countdown timer
- show success/failure/expired pages

Hosted page must look modern and premium.

---

## 5.2 Guest Payment Simulation
Guest may perform a simulated payment flow:
- click "Pay Now"
- input mock OTP/PIN
- simulate scan
- generate VA payment
- mock 3DS redirect for card

However, the final authority is still tenant manual override.

Guest interaction only generates "payment attempt" data.
The final outcome is confirmed by tenant override.

---

# 6) How the System Works (End-to-End Workflow)

This is the main system behavior.

---

## 6.1 Step 1 - Tenant Integrates API
Tenant builds integration in their own application.

Tenant uses MockPay API like a real gateway.

Tenant stores:
- their own customer data
- their own order table
- their own business logic

MockPay stores only transaction simulation data.

---

## 6.2 Step 2 - Tenant Creates Transaction
Tenant application calls MockPay API:

- `POST /api/v1/payment/create`

MockPay returns:
- transaction_id
- payment_url (optional hosted page)
- expired_at

MockPay status starts as:
- `pending`

---

## 6.3 Step 3 - Tenant Application Initiates Payment
Tenant application can choose 2 integration modes:

### Mode A - Hosted Payment Page
Tenant redirects customer to:

- `payment_url`

Customer uses MockPay hosted UI to attempt payment.

### Mode B - API Only
Tenant builds their own UI and never redirects to MockPay.

Tenant uses API calls to:
- fetch transaction status
- show instructions
- simulate payment attempt

---

## 6.4 Step 4 - Guest Attempts Payment (Optional)
If tenant uses hosted payment page:
- guest selects method
- guest performs mock flow

MockPay records:
- payment attempt data
- payment method details

Transaction still stays in `pending` unless tenant confirms outcome.

---

## 6.5 Step 5 - Tenant Performs Manual Override (Required)
Tenant logs into MockPay dashboard.

Tenant opens transaction detail page and chooses outcome:

- Approve (Success)
- Reject (Failed)
- Expire
- Cancel
- Refund

MockPay updates transaction status immediately.

This is the official final decision.

---

## 6.6 Step 6 - MockPay Sends Webhook
After override:
- MockPay generates payload
- signs payload using tenant webhook secret
- sends webhook to tenant webhook URL
- retries on failure
- logs request/response

---

## 6.7 Step 7 - Tenant Application Responds
Tenant application receives webhook and executes business logic:

Example:
- success -> mark order as paid, deliver product
- failed -> show payment error, allow retry
- expired -> cancel order
- refund -> revert order/payment

This is the actual goal of MockPay:
testing tenant application behavior.

---

## 6.8 Step 8 - Tenant Downloads Result (Testing Evidence)
Tenant can download the transaction result:

- JSON payload
- PDF report
- webhook response logs
- status timeline

This file is used for:
- QA documentation
- team reporting
- integration debugging
- proof of testing

---

# 7) Tenant Isolation & Security Model

Tenant isolation is mandatory.

All tenant data must be scoped strictly:
- transactions
- api keys
- webhook logs
- settlements
- refunds
- reports
- exports

Platform admin must not access tenant operational records.

---

## 7.1 Data Ownership
Tenant owns:
- API keys
- webhook secrets
- transaction metadata
- simulation history
- webhook payload logs

MockPay acts only as storage + simulator.

---

## 7.2 Authorization Rules
Tenant can only:
- read/write resources where `tenant_id` matches authenticated tenant

Guest can only:
- access hosted payment page by transaction_id token

Platform admin can only:
- manage tenant account status and plan

---

# 8) Mandatory Tenant Features Checklist

Tenant dashboard MUST include:

- Authentication
- API key management
- Webhook settings + logs + retry
- Transaction list + filters
- Transaction detail view
- Manual override controls
- Download transaction test result (JSON/PDF)
- Export report (CSV/Excel)
- Developer tools (docs + examples)
- Donation upgrade system

---

# 9) Mandatory Guest Features Checklist

If hosted payment page is enabled:

- Payment selection UI
- Method-specific simulation UI
- Success / Failed / Expired pages
- Countdown timers
- Copyable VA / QR / payment code
- Modern premium UI template

---

# 10) Summary

MockPay is a tenant-driven simulation platform.

- Tenant owns all simulation outcomes.
- Tenant controls override and testing results.
- Guest is optional and only interacts with hosted payment UI.
- Platform admin only manages SaaS operations and tenant lifecycle.
- Every transaction produces downloadable testing evidence.

MockPay exists to help tenants validate their payment integration behavior before going live.
