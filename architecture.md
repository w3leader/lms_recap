# Architecture

## System Shape

Both projects follow a conventional Laravel architecture:

```text
Browser
  -> Laravel routes
  -> controller logic
  -> database / session
  -> Blade view
  -> Bootstrap / JavaScript enhancements
```

## Layers

### Route Layer

Routes define the product surface:

- public login and registration pages
- authenticated user pages
- admin pages
- CRUD endpoints for admin tables
- exam navigation and submission routes

### Business Layer

Controllers coordinate the real work:

- validating form input
- loading model data
- applying user role and approval rules
- creating or updating admin records
- calculating exam results
- returning table data and detail views

### Persistence Layer

The core data model in `smart_lms` includes:

- users
- exams
- question categories
- questions
- scores
- documents
- posts
- contacts

### Presentation Layer

The UI is mostly Blade plus Bootstrap:

- shared layout shell
- auth-aware navigation
- forms
- admin tables
- student pages
- result views

JavaScript is used for enhancement, not as the whole application runtime.

### State Layer

The most important state problem is the exam flow:

- current exam progress
- selected answers
- page navigation
- score calculation
- best-score history

This is a good interview topic because it shows workflow correctness, not only UI rendering.

## Design Tradeoff

Blade was a reasonable choice because the apps are form-heavy and admin-heavy. A full SPA would add client-side complexity without automatically improving the product.

For a React or Astro company, the useful message is:

> "I understand the boundary between server-rendered product UI and client-side interaction. I can translate the same product thinking into React or Astro when the product needs it."
