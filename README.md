# X Like Wall

This is a simple, Twitter/X-like posting board application built using PHP, JavaScript, and CSS. It allows users to create, view, like, and delete anonymous posts, mimicking Twitter’s (X’s) layout and functionality. Posts are stored server-side in a text file (posts.txt) and updated live in the browser using AJAX. The app is developed and edited in Neovim, served via PHP’s built-in server, and managed with tmux for a streamlined workflow.

## Features

* Anonymous Posting - Users can submit text posts anonymously, numbered sequentially (e.g., “Anonymous - 1”), alternated gifs for profile pics. 

* Live Updates - Posts, likes, and deletions update in real-time without page reloads using JavaScript and AJAX.

* Like System - Posts have a “Like” button with a Twitter-like heart animation (pulse effect) and a count, persisting client-side with localStorage (or optionally server-side with PHP).

* Delete Posts - Users can delete individual posts with a “Delete” button.

* Responsive Design - The app is fully responsive, with symmetrical post boxes, text wrapping, and mobile-friendly layouts for desktops and phones.

* X-Like Layout - Posts feature content at the top, a divider line, and action buttons (Comment, Repost, Like, Delete) at the bottom, centered and evenly spaced.

## File Structure

Below is the structure of the key files in this Twitter/X-inspired posting board project, located in the root directory of the repository:

* index.php: The main HTML/PHP file that serves as the interface, loads initial posts, and handles form submissions.

* styles.css: Contains CSS styling for posts, the input box, buttons, and responsive design for desktop and mobile.

* script.js: JavaScript file managing live updates, posting, liking, deleting, and dynamic interactions via AJAX.

* save_post.php: PHP script responsible for saving new posts to posts.txt on the server.

* delete_post.php: PHP script for deleting specific posts from posts.txt.

* load_posts.php: PHP script that returns posts as JSON for real-time updates in the browser.

* posts.txt: A text file storing all posts, with one post per line, located in the root directory.
![Screenshot 2025-03-04 at 8 52 56](https://github.com/user-attachments/assets/8eba7b81-46f3-4b97-8249-e72bbf568f72)
![Screenshot 2025-03-04 at 8 56 16](https://github.com/user-attachments/assets/64472553-4d64-43a7-8e39-864c758f52ab)


