# STAR Stories

Use these as interview templates. Only claim the stories that match real work you can explain.

## Story 1: Exam State Correctness

**Situation:** Students needed to move through a multi-question exam without losing answers or corrupting the final score.

**Task:** Keep exam progress consistent across page navigation and submission.

**Action:** Store exam state in the session, control the navigation path, and calculate results from the recorded answer log.

**Result:** The exam workflow became reliable: users could navigate, submit, and receive consistent scoring.

Interview line:

> "The main frontend problem was not visual rendering. It was preserving workflow state correctly across a multi-step user journey."

## Story 2: Admin Search Race Condition

**Situation:** An admin listing can become unstable when search requests return out of order during fast typing.

**Task:** Make search results match the latest user input.

**Action:** Debounce the search input, cancel or ignore stale requests, and update the table only from the latest request.

**Result:** The listing becomes predictable and avoids showing old results after newer input.

Interview line:

> "I treat admin search as a concurrency problem, not just an input field."

## Story 3: Infinite Loop Debugging

**Situation:** A frontend state update can accidentally trigger the same render or watcher again.

**Task:** Stop the loop while keeping the intended state update.

**Action:** Trace the mutation path, separate source state from derived state, and remove circular updates.

**Result:** Rendering stabilizes and the UI no longer locks up.

Interview line:

> "I debug infinite loops by mapping which state change causes the next state change."

## Story 4: Memory Leak Investigation

**Situation:** A page can get slower after repeated navigation, modal usage, or table refreshes.

**Task:** Identify what keeps growing in memory.

**Action:** Inspect event listeners, timers, component cleanup, and retained DOM references.

**Result:** Remove retained listeners or stale references so memory returns after the interaction ends.

Interview line:

> "The issue is often lifecycle cleanup, not the size of the data itself."

## Story 5: Role-Based UI And Route Protection

**Situation:** Admin and student users need different access and different UI paths.

**Task:** Prevent invalid access while keeping the interface clear.

**Action:** Protect routes with middleware, separate admin and student workflows, and render navigation based on auth state.

**Result:** The app has cleaner boundaries and fewer accidental misuse paths.

Interview line:

> "I do not rely on hiding buttons alone. Access control belongs at the route boundary."
