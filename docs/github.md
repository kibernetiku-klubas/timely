# GitHub Collaboration Guide

## Repository Information
Repository: [timely](https://github.com/kibernetiku-klubas/timely)

## Table of Contents
- [Introduction](#introduction)
- [1. Setting Up the Project](#1-setting-up-the-project)
    - [1.1 Setup](#11-setup)
- [2. Branching Strategy](#2-branching-strategy)
    - [2.1 Feature Branches](#21-feature-branches)
    - [2.2 Naming Convention](#22-naming-convention)
    - [2.3 Branching from Master](#23-branching-from-master)
    - [2.4 Commit Strategy](#24-commit-strategy)
- [3. Developing Features](#3-developing-features)
    - [3.1 Working in Feature Branches](#31-working-in-feature-branches)
    - [3.2 Keeping Branch Up-to-date](#32-keeping-branch-up-to-date)
- [4. Pull Requests](#4-pull-requests)
    - [4.1 Creating a Pull Request](#41-creating-a-pull-request)
    - [4.2 Review Process](#42-review-process)
    - [4.3 Squash and Merge](#43-squash-and-merge)
- [5. Avoid Pushing to Master](#5-avoid-pushing-to-master)
    - [5.1 Direct Pushes to Master](#51-direct-pushes-to-master)
    - [5.2 Feature Branches for Collaboration](#52-feature-branches-for-collaboration)
- [6. Running Tests](#6-running-tests)
    - [6.1 Running Tests with PhpStorm](#61-running-tests-with-phpstorm)
    - [6.2 Ensuring Test Pass](#62-ensuring-test-pass)
- [7. Task Description](#7-task-description)
- [8. Code Review](#8-code-review)

## Introduction
This guide serves as a comprehensive resource for project contributors,
outlining efficient practices for collaborating on a GitHub repository.
It covers guidelines for creating feature branches, submitting pull requests,
and underscores the significance of refraining from direct commits to the master branch.
Adhering to these instructions ensures a seamless and collaborative development process.

## 1. Setting Up the Project
To begin contributing, follow these steps for setting up the project and configuring your IDE:

### 1.1 Setup
- Follow the steps in [setup](setup.md).

## 2. Branching Strategy
Efficient branching is crucial for organized collaboration. Follow these guidelines:

### 2.1 Feature Branches
Create a new branch for each feature or bug. Branches should be short-lived and focused on a single task.

### 2.2 Naming Convention
Maintain a consistent naming convention for branches
(e.g., "feature/add-user-authentication" or "bugfix/fix-login-validation").

### 2.3 Branching from Master
Always create feature branches from the latest master branch to ensure up-to-date codebase.

### 2.4 Commit Strategy
Use frequent, small commits rather than large ones. Commit messages should be clear and descriptive.

## 3. Developing Features
Work on your feature or bug fix in your branch:

### 3.1 Working in Feature Branches
Switch to your branch and commit changes regularly with clear messages.

### 3.2 Keeping Branch Up-to-date
Pull from the upstream repository to sync with team changes.

## 4. Pull Requests
Submit a pull request (PR) on GitHub when your feature is ready for review:

### 4.1 Creating a Pull Request
Push your branch, create a PR with a descriptive title and detailed description of changes.

### 4.2 Review Process
Assign reviewers, address feedback, and wait for approval before merging.

### 4.3 Squash and Merge
Consider "Squash and merge" for a cleaner commit history.

## 5. Avoid Pushing to Master
Prevent issues by following these practices:

### 5.1 Direct Pushes to Master
Only update master through approved pull requests.

### 5.2 Feature Branches for Collaboration
Collaborate efficiently using feature branches.

## 6. Running Tests
Ensure code quality by testing:

### 6.1 Running Tests with PhpStorm
Execute tests using `php artisan test` or PhpStorm's integrated tools.

### 6.2 Ensuring Test Pass
Confirm that all tests pass before proceeding.

## 7. Task Description
Clearly describe tasks and their impact:
Include function modifications, new function creation, and PR decision.

## 8. Code Review
Always review existing pull requests before starting work.

### Your commitment to these guidelines will foster a collaborative and productive development environment. Happy coding!
