# Scoring Web App (LAMP Stack)

## Overview

This is a minimal web application built on the LAMP stack (Linux/Windows with Apache, MySQL, PHP) that allows judges to score participants in an event. The accumulated scores are displayed on a public scoreboard, updated dynamically.

---

## Features

- **Admin Panel**: Add judges with unique usernames and display names.
- **Judge Panel**: Judges can view participants and submit scores (1-100).
- **Public Scoreboard**: Displays all participants sorted by total points, with color-coded highlights.
- Auto-refresh scoreboard every 30 seconds to show real-time updates.
- Basic client-side and server-side input validation.
- Clear code structure separating config, public views, and SQL schema.

---

## Setup Instructions

1. **Clone the repository:**

   ```bash
   git clone https://github.com/MunkushiR/scoring-web-app-lamp.git
   cd scoring-web-app-lamp
