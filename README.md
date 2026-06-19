# Laravel Product Showcase

Portfolio summary for two Laravel product projects:

- `w3leader/smart_lms`
- `w3leader/myProfit`

This repo is a curated interview showcase. It explains what the systems do, how the parts connect, and how to talk about the engineering work for a Lead Deputy Frontend role.

## Positioning

These projects are Laravel applications with Blade, Bootstrap, JavaScript, and Laravel Mix. `smart_lms` also includes Vue 2 scaffolding and frontend enhancement points.

The strongest way to present them is not as React, Astro, or modern Vue projects. Present them as product systems where the frontend work sits inside a server-rendered architecture.

## What This Shows

- Building complete business workflows, not isolated UI screens
- Designing admin and student experiences around role, state, and data access
- Working with server-rendered UI, JavaScript enhancements, and asset bundling
- Understanding when a simple Blade UI is enough and when client-side behavior is worth adding
- Debugging frontend problems through state flow, lifecycle, and request behavior

## Projects

### Smart LMS

Smart LMS is a learning management system for online exams and learning materials.

It includes:

- student registration and approval
- admin-managed question bank
- exam creation and scoring
- session-based exam flow
- result history and analytics
- document and content management

Interview angle:

> "This project shows how I design product workflows end to end: routes, role access, data models, admin UI, student UI, and state correctness during exams."

### myProfit

myProfit is a Laravel business/admin application with a conventional Blade layout and Bootstrap UI.

It shows:

- auth-gated app shell
- reusable Blade layout
- Laravel Mix asset delivery
- pragmatic server-rendered UI

Interview angle:

> "This project shows practical delivery of admin-style product screens without overbuilding a single-page application."

## How To Use This Repo

- Read `architecture.md` for the system design explanation.
- Read `component-thinking.md` for frontend framing.
- Read `star-stories.md` for interview answers.
- Read `selected-code-evidence.md` for the files worth showing from the original repos.

## Honest Stack Statement

Use this in interviews:

> "The original projects are Laravel Blade applications with JavaScript enhancements. I can work with React and Astro, but these examples show product architecture, state flow, admin UX, and debugging judgment rather than a specific frontend framework."
