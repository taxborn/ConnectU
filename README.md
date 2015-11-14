## Synopsis

**ConnectU** is a social networking website based off of Material Design. This is a project started back in late-August of 2015. It started as a small way to get into Laravel development, but turned into a big project that consumed most of my free time.

## Motivation

I originally started on this project because I just wanted to get started into Laravel development because that framework intrigued me. After a few weeks or so of development, I really got into it. I did more and more until it became a full-fledged network, now known as [ConnectU](http://www.connectu.xyz).

## Installation
ConnectU is relatively easy to set up, there is just two commands to get set up and ready to go. Just be sure to have composer installed, it will also help to have [Git](http://www.git-scm.com) installed.

Although there are just a few commands to do, I would highly recommend using [Laravel Homestead](http://laravel.com/docs/5.1/homestead), as this makes developing in general easier.

Also, you are going to need to rename the .env.example to just .env. This is where you will store your database settings so you can get all setup.

1. Goto your command line and type this: git clone https://github.com/BraxtonFair/ConnectU.git
2. After it has downloaded, type this into the command line: composer install
3. Once Composer has downloaded all the requirements, type one last command to get all setup server-side: php artisan migrate

Now let's go over what each command does.

1. git clone https://github.com/BraxtonFair/ConnectU.git: This clones or copies the repository to your local machine
2. composer install: This command installs all the requirements that the project needs.
3. php artisan migrate: This sets up the MySQL database with the tables and rows needed.

## Prerequisites
1. [XAMPP](https://www.apachefriends.org/index.html) (or something similar that supports PHP and MySQL)
2. [Composer](http://getcomposer.org)

## Contributors

Right now, I, [Braxton Fair](http://www.github.com/braxtonfair) is the only person working on ConnectU. If you'd like to be a contributor, create a pull request and start your own branch. If you have done enough changes and solves some issues, I will add you as a contributor. Depending on what you have done, I will assign you to different parts of the project and  you do have a say in what you want to do.

## License

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
