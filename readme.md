<!-- PROJECT LOGO -->
<br />
<p align="center">
  <a href="https://github.com/quarkmarino/blog.test">
    <img src="logo.png" alt="Logo" width="80" height="80">
  </a>

  <h3 align="center">A full stack demo project of a blog with Laravel & jQuery</h3>

  <p align="center">
    A web site allows the managements of 2 type of resources, Users, and Blog posts.
    <br />
    <a href="https://github.com/quarkmarino/blog.test">View Demo</a>
  </p>
</p>

<!-- TABLE OF CONTENTS -->
<details open="open">
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#blog-guidelines">Blog Guidelines</a>
      <ul>
        <li><a href="#task-description">Task description</a></li>
      </ul>
    </li>
    <li>
      <a href="#requirements">Requirements</a>
      <ul>
        <li><a href="#users">Users</a></li>
        <li><a href="#pages">Pages</a></li>
        <li><a href="#admin">Admin</a></li>
        <li><a href="#supervisor">Supervisor</a></li>
        <li><a href="#blogger">Blogger</a></li>
      </ul>
    </li>
    <li><a href="#instalation">Installation</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
  </ol>
</details>



# Blog Guidelines

Technologies that needs to be used for developing the code:
- [x] Laravel version 5.7 https://laravel.com/docs/5.7
- [x] Twitter bootstrap min version 3.3
    - [x] with Flex layout is preferable
- [x] Jquery HTML/CSS
- [x] Mysql or Mariadb

Please share the code via git once ready

## Task description

The test project is a simple blog creation and management application with different user types having different access.
This project will give us an idea about your Laravel skills and code quality. Major efforts in css styling is not required.
Basic usage of twitter bootstrap and jquery is required.

## Requirements

### Users

1. There are 3 different types of users:
    * [x] Admin
    * [x] Supervisor
    * [x] Blogger
    ---
    - [x] By default all new users are added as ‘Blogger’.
    - [x] Create a database seeder for the initial ‘Admin’ account

2. The fields for users are:
    > Please add any additional fields as you seem necessary.
    * [x] first name
    * [x] last name
    * [x] email
    * [x] user type
    * [x] last login
        * [x] Update last_login field at login event.
3. The fields for blogs are:
    > Please add any additional fields as you seem necessary.
    * [x] blog name
    * [x] description

4. Each user will have different access according to their user type.

    4.1. Admins have full access over users and blogs, and can:
    * [x] view (index)
    * [x] search (query)
    * [x] add (post)
    * [x] edit (put)
    * [x] delete (delete)

    4.2. Supervisors have the following access over their own blogs and for the ‘Blogger’ users assigned under them, they can:
    * [x] view (index)
    * [x] search (query)
    * [x] add (post)
    * [x] edit (put)
    * [x] delete (delete)

    4.3. Bloggers can (over their own blogs):
    * [x] view (index)
    * [x] search (search)
    * [x] add (post)
    * [x] edit (put)
    * [x] delete (delete)

### Pages

Create the following pages:
* [x] Login
* [x] Registration
---
* [x] Admin dashboard
* [x] Supervisor dashboard
* [x] Blogger dashboard
---
* [x] Users page
* [x] Supervisors page
* [x] Blogs page
---

### Admin
Will have access to the following pages:
* [x] Admin dashboard
* [x] Users page
* [x] Supervisors page
* [x] Blogs page

1. ‘Admin dashboard’. The dashboard will list:
    * [x] Their personal details.
    * [x] They can update their personal details via a bootstrap modal.
    * [x] The dashboard will also list the total number of blogs (posts) and users by user types.

2. ‘Users page’
    * [x] This page will list all the users with pagination of 20.
    * Admins can do the following for users from this page
        * [x] create
        * [x] edit
        * [x] delete
    * [x] The admin users can filter users by user types.
    * [x] Many to Many (Supervisor-Blogger relationship)
    * [x] Admins can assign multiple ‘Blogger’ users to a ‘Supervisor’ user account and a ‘Blogger’ can also be under multiple ‘Supervisor’ users.

3. ‘Supervisors page’
    * [x] This page will list out all the ‘Supervisor’ users and the ‘Blogger’ users that are under them.

4. ‘Blogs page’
    * [x] This page will list out blogs with pagination of 20 from all the users types:
    * ‘Admin’
    * ‘Supervisor’
    * ‘Blogger’
* The admins can do the following, over any of the listed blogs:
    * [x] search the blogs
    * [x] add
    * [x] edit
    * [x] delete

### Supervisor
Will have access to the following pages:
* [x] Supervisor dashboard
* [x] Users page
* [x] Blogs page

1. Supervisor dashboard’. The dashboard will list their personal details.
    * [x] They can update their personal details via a bootstrap modal.
    * [x] The dashboard will also list the total number of blogs and users that are assigned to them as:
        * ‘Blogger’

2. ‘Users page’
    * [x] This page will list out all the ‘Blogger’ users assigned to the supervisor account.
    * [x] They can only view these details but can’t change anything.

3.  ‘Blogs page’
    * [x] This page will list out blogs created by them and from the ‘Blogger’ users that are assigned under them with the pagination of 20.
    * The supervisors can do the following, over any of the listed blogs :
        * [x] search the blogs
        * [x] add
        * [x] edit
        * [x] delete

### Blogger
Will have access to the following pages:
* [x] Blogger dashboard
* [x] Blogs page

1. ‘Blogger dashboard’
    The dashboard will list:
    * [x] Their personal details
        * [x] They can update their personal details via a bootstrap modal.
    * [x] Last login
    * [x] The number of blogs that they have created.

2. ‘Blogs page’:
    * [x] This page lists all the blogs created by the user with pagination of 20
    * [x] It must have ability to search content for the blogs via a search field.
    * [x] The bloggers can do the following over the blogs from this page:
        * [x] create
        * [x] edit
        * [x] delete

### Installation

1. Clone the repo
   ```sh
   git clone git@github.com:quarkmarino/blog.test.git
   ```
2. Install Composer dependencies
   ```sh
   cd blog.test
   composer install
   ```
3. Run artisan migrations
   ```sh
   art migrate
   ```
4. Run artisan db seeders (admin user only sedding or full db seeding)
  4.1 Run admin user seeder only
   ```sh
   art db:seed --class=AdminUserSeeder
   ```
  4.2 Run full db seeder (with admin user included)

<!-- LICENSE -->
## License

Distributed under the MIT License. See `LICENSE` for more information.

<!-- CONTACT -->
## Contact

Jose Mariano Escalera Sierra - [@quarkmarino](https://twitter.com/quarkmarino) - mariano.pualiu@gmail.com

Project Link: [https://github.com/quarkmarino/blog.test](https://github.com/quarkmarino/blog.test)
