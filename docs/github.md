# Using GitHub for this project

Currently, this project's repository is under Kibernetiniu Gudruoliu Bendruomene GitHub organisation in
https://github.com/kibernetiniu-gudruoliu-bendruomene/first-project.git

Guide to Contributing to GitHub Repo from JetBrains IDE

Introduction:
This guide provides instructions and best practices for a programming team on how to contribute
to a GitHub repository using JetBrains IDE. It outlines the rules for creating feature branches,
submitting pull requests, and emphasizes the importance of avoiding direct pushes to the master branch. 
Following these guidelines will help ensure a smooth and collaborative development process.

1. Setting Up the Project:
   - Follow the steps in [setup](setup.md)
   
   - For setting up IDE follow [IDE-setup](ide.md)
2. Branching Strategy:
   - Feature branches: For every new feature or bug fix, create a new branch. Use a descriptive name that reflects the purpose of the branch. Create the branch locally using the JetBrains IDE's Git integration.
   
   - Naming convention: Follow a consistent naming convention for branches, such as using a prefix or a combination of the feature name and a unique identifier. For example, "feature/add-user-authentication" or "bugfix/fix-login-validation".
   
   - Branch from the latest master: Always create your feature branches from the latest state of the master branch to ensure you have the most up-to-date codebase.

   - Use many small commits in a branch instead of one large. 

3. Developing Features:
   - Work in your branch: Switch to your feature branch and start working on your feature or bug fix. Commit your changes frequently, adhering to good coding practices and clear commit messages.
   
   - Regularly pull from the upstream: To keep your feature branch up to date with the latest changes from other team members, regularly pull from the upstream repository using JetBrains IDE's Git integration.

4. Pull Requests:
    - Create a pull request: Once your feature or bug fix is complete, push your branch to the remote repository and create a pull request (PR) on GitHub. Provide a descriptive title and detailed description of the changes made.

    - Reviewers and approvals: Assign relevant team members as reviewers for the PR. Wait for their feedback and address any requested changes. Once approved, the PR can be merged.

    - Squash and merge: To maintain a clean commit history, consider using the "Squash and merge" option when merging the PR. This combines all the commits into a single commit, making the history more readable.

5. Avoid Pushing to Master:
   - Direct pushes to master: It is crucial to avoid pushing directly to the master branch. The master branch should only be updated through approved pull requests.

   - Use feature branches for collaboration: By creating feature branches, multiple team members can work concurrently without conflicting with each other. It also allows for easy code review and collaboration before merging into the master branch.

