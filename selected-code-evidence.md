# Selected Code Evidence

These are the files worth showing from the original projects.

## Smart LMS

### `README.md`

Shows the product scope:

- LMS feature set
- exam engine
- admin management
- student flow
- result analytics
- database tables

### `routes/web.php`

Use this to explain:

- route structure
- admin routes
- authenticated user routes
- exam workflow routes
- CRUD endpoints

### `resources/views/layouts/app.blade.php`

Use this to explain:

- shared application shell
- auth-aware navigation
- Blade layout composition
- asset loading

### `app/Http/Controllers/personal/ExaminationController.php`

Use this to explain:

- randomized question selection
- session-backed answer state
- score calculation and pass/fail logic
- best-score update behavior

### `app/Http/Controllers/admin/ResultController.php`

Use this to explain:

- admin result aggregation
- pass/fail counts
- max/min/average score reporting
- DataTables response shape

### `resources/views/personal/exam/exam_testing.blade.php`

Use this to explain:

- exam question navigation
- selected answer persistence
- Blade UI connected to Ajax answer updates

### `resources/views/admin/result/result.blade.php`

Use this to explain:

- result dashboard UI
- summary metrics
- DataTables-driven analytics table

### `webpack.mix.js`

Use this to explain:

- asset bundling
- Sass pipeline
- Vue compilation support

## myProfit

### `resources/views/layouts/app.blade.php`

Use this to explain:

- conventional Laravel auth shell
- shared layout
- Bootstrap-based UI

### `resources/views/home.blade.php`

Use this to explain:

- simple page composition
- extending a shared Blade layout
- authenticated dashboard pattern

### `app/Http/Controllers/DataTableController.php`

Use this to explain:

- date-filtered admin listings
- server-side table payloads
- status mapping and conditional actions

### `app/Http/Controllers/BigStockController.php`

Use this to explain:

- stock lookup flow
- inventory update workflow
- stock log creation
- multi-table consistency concerns

### `resources/views/page_view/admin_user.blade.php`

Use this to explain:

- admin listing page structure
- DataTables UI
- modal-driven create/edit/remove flow

### `resources/views/page_view/report.blade.php`

Use this to explain:

- chart-driven reporting screen
- Ajax calls to reporting endpoints
- frontend aggregation for visual summaries

### `webpack.mix.js`

Use this to explain:

- Laravel Mix pipeline
- server-rendered UI with bundled assets

## Code Review Note

For portfolio presentation, show small excerpts only. The goal is to prove the system shape, not to show every file.
