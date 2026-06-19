# Component Thinking

Even in Blade projects, the UI can be explained in component terms.

## Application Shell

Purpose:

- consistent layout
- auth-aware navigation
- shared scripts and styles
- reusable page container

Original evidence:

- `resources/views/layouts/app.blade.php`

## Admin Listing Pattern

Purpose:

- searchable table
- create / edit / delete workflows
- detail view
- backend-driven data access

Examples in Smart LMS:

- users
- exams
- questions
- documents
- results
- content

## Student Exam Flow

Purpose:

- show available exams
- start an exam
- navigate questions
- keep selected answers
- submit and show result

This is the strongest frontend story because it requires clear state thinking.

## Shared UI Patterns

Patterns worth discussing:

- form validation feedback
- alert and status messages
- table filters
- modal detail views
- role-based navigation
- empty states and loading states

## How To Translate This To React Or Astro

If asked how this maps to their stack:

- Blade layout becomes React or Astro layout components.
- Admin tables become reusable table components.
- Exam runner becomes a stateful React component or island.
- Laravel routes can become API endpoints.
- Server-rendered pages can stay Astro pages where static or content-heavy.

The key point:

> "The component model is transferable. The syntax changes, but the state boundaries and user workflows are the real design work."
