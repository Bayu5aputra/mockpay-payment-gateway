# Agent Guidelines

You are an AI coding agent working on a Laravel 11+ application.

Your job is to implement real, production-ready code changes in this repository with minimal diffs, following existing project conventions. Do not generate boilerplate or fake placeholders.

---

## Commands

### Tests
- Run all tests: `php artisan test`
- Run PHPUnit directly: `vendor/bin/phpunit`
- Run a single test file: `vendor/bin/phpunit tests/Feature/ExampleTest.php`
- Run a single test method: `vendor/bin/phpunit --filter test_method_name`
- Run a specific test class: `php artisan test --filter=ExampleTest`

### Lint / Format
- Pint (Laravel): `./vendor/bin/pint`
- PHP-CS-Fixer (if configured): `vendor/bin/php-cs-fixer fix -vvv --show-progress=dots`
- Static analysis (if configured): `./vendor/bin/phpstan analyse`

### Cache / Build
- Clear cache: `php artisan optimize:clear`
- Optimize: `php artisan optimize`
- Config cache: `php artisan config:cache`
- Route cache: `php artisan route:cache`

### Database
- Run migrations: `php artisan migrate`
- Fresh migrate with seed: `php artisan migrate:fresh --seed`

---

## Output Rules (Strict)

- Output ONLY code changes and required shell commands.
- Do NOT output explanations, summaries, or markdown formatting.
- Do NOT output multi-file templates unless required.
- Do NOT create unnecessary new files.
- Do NOT include placeholder code, TODOs, or incomplete implementations.
- Do NOT provide code previews, code blocks, or full file outputs.
- Apply changes directly by editing the existing files in the repository.
- Only output terminal commands when necessary (migrate/test/lint).

---

## Coding Standards

- PHP version: 8.2+
- Framework: Laravel 11+
- Always enable strict typing: `declare(strict_types=1);`
- Always use type hints (params + return types).
- Prefer compact nullable syntax: `?Type`
- Prefer enums over magic strings when appropriate.
- Prefer DTOs / value objects when complexity grows.
- Follow SOLID principles and avoid duplicate logic.

---

## Laravel Conventions

- Use Form Requests for validation.
- Use Policies / Gates for authorization.
- Use Services / Actions for non-trivial business logic.
- Use Eloquent relationships and query scopes properly.
- Prefer Eloquent query builder bindings over raw SQL.
- Use transactions for multi-write operations.
- Use queue jobs for slow or async tasks.
- Prefer Laravel helpers (`Str`, `Arr`, `Carbon`) when appropriate.

---

## Code Style

- Use short array syntax: `[]`
- Use trailing commas in multiline arrays/arguments.
- Prefer single quotes `'...'` unless interpolation is required.
- Imports must be alphabetically ordered.
- Prefer importing classes/functions/constants instead of repeating fully-qualified names.
- No yoda conditions (`$value === 'x'`, not `'x' === $value`).
- Avoid deep nesting; prefer early returns.

---

## UI / View Guidelines (Blade / Frontend)

If you create new UI screens, pages, Blade views, components, or admin panels:

- The UI must look modern, premium, and visually polished.
- Avoid generic bootstrap-like layouts and template-looking UI.
- Avoid repetitive AI-like layouts (basic centered card, flat buttons, default gradients).
- Prefer modern spacing, strong typography hierarchy, subtle shadows, glassmorphism accents, and refined border radiuses.
- Use clean UI patterns: sections, cards, badges, stats blocks, tables with hover states.
- Use subtle micro-interactions (hover/active states) and smooth transitions.
- Design must feel human-made: asymmetric layouts, interesting composition, balanced whitespace.
- Use meaningful icons and UI labels (no generic placeholders).
- Ensure responsive layout for mobile/tablet/desktop.
- Follow accessibility basics (contrast, focus states, semantic HTML).
- Prefer TailwindCSS if available; otherwise follow the repository frontend stack.

---

## Validation Rules

- Validate ALL external inputs:
  - HTTP request payload
  - query parameters
  - file uploads
  - headers
  - webhook payloads
  - CLI args
  - env/config values if user-controlled

- Use FormRequest validation whenever possible.
- Never trust client-provided IDs; always authorize access.

---

## Security Policy (Non-Negotiable)

- Never hardcode secrets, tokens, API keys, or passwords.
- Always prevent SQL injection by using parameter binding / Eloquent safely.
- Never build SQL queries via string concatenation.
- Prevent XSS by escaping output; never trust user-generated HTML.
- Prevent SSRF: never allow arbitrary external URLs without strict whitelisting.
- Prevent path traversal: never trust filenames/paths from user input.
- Ensure authentication and authorization are enforced consistently.
- Do not weaken middleware, policies, guards, or permission checks.
- Do not leak sensitive information in exceptions, logs, or API responses.
- Ensure uploads are validated (type, size, MIME) and stored securely.
- Use hashing for passwords (`Hash::make`) and never log credentials.

---

## Reliability & Error Handling

- Use structured exceptions and meaningful error responses.
- Avoid leaking stack traces in production responses.
- Ensure idempotency for webhook/queue processing when applicable.
- Handle null values, missing records, race conditions, and retries.
- Use database transactions for multi-step operations.

---

## Performance Guidelines

- Avoid N+1 queries; use eager loading (`with`, `load`).
- Use pagination for large datasets.
- Avoid loading unnecessary columns; use `select()` when needed.
- Prefer chunking/streaming for large processing.
- Avoid expensive operations inside loops.

---

## Testing Rules

- Add or update tests when behavior changes.
- Tests must be deterministic and not rely on external network calls.
- Prefer Feature tests for endpoints and integration.
- Prefer Unit tests for isolated business logic.
- Use database transactions / RefreshDatabase trait properly.

---

## Deliverable Expectations

- Changes must be production-ready and runnable.
- Must follow existing architecture and conventions in this repository.
- Must not introduce breaking changes unless explicitly requested.
- Ensure code passes tests and formatting tools configured in the project.
