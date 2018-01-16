### Digital Ocean

-----
![](https://d3vv6lp55qjaqc.cloudfront.net/items/2J0S130Y0Y0F3D393g07/Digital-Ocean-Logo1.png?X-CloudApp-Visitor-Id=1094421)

>Follow the steps below to create your own server. If these steps aren't clear enough, you can 
view an online tutorial [here](https://www.digitalocean.com/community/tutorials/how-to-create-your-first-digitalocean-droplet-virtual-server).

-----

#### A. [Sign up](https://cloud.digitalocean.com/registrations/new) for Digital Ocean.

This will cost you around $5.00 + tax for the entire month.

Use the code __`DROPLET10`__ for a $10 dollar credit for "new" users.

-----


#### B. [Create a new Droplet](https://cloud.digitalocean.com/droplets/new)

### Create Droplets
#### Choose an image:
- Click on the tab "One-click Apps" and choose:

![](https://d3vv6lp55qjaqc.cloudfront.net/items/2n1c2B2K1i2N1L3E2O3P/lamp16.png?X-CloudApp-Visitor-Id=1094421)

#### Choose a size

![](https://s3.amazonaws.com/f.cl.ly/items/3I3W2y1b0r2h2o3f1N2Z/Screen%20Shot%202016-06-05%20at%209.20.04%20PM.png)

#### Choose a datacenter region
> Default of New York is fine.

#### Select additional options
> Don't choose any (unless you want to)

#### Add your SSH keys
> Skip, we will address ssh keys later.

#### Finalize and create
- How many Droplets?
> Only need 1 droplet

- Choose a hostname
> Your hostname is the name of your server and it's what you see when you log in. This is not a domain name!

-----

#### C. IP Address & Password

- The IP address that is assigned to your "droplet", is your only connection to your server.
- The root password will be emailed to you.
- You need both IP address & password to access your new server.

#### D. Accessing Your Server

- Open some type of "terminal" (like [putty](http://www.chiark.greenend.org.uk/~sgtatham/putty/download.html)) application and log into your server using:
    - The IP address given to you
    - The password emailed to you
- Change your root password!
    - Run the following command (note: the dollar `$` sign just implies "command line", don't use it in the command):
    - `$ passwd`
    - Follow the prompts.
- Add yourself as a user:
    - `$ adduser your-new-username`
    - Follow the prompts.
    - Stay root for now, but as soon as you add 'your-new-username' to `sudoers`, you should change to your new user:
    - `$ su your-new-username`
- Add me as a user:
    - `$ adduser griffin`
    - Set my password as `2D2016!!!`, I will change it as necessary.
- Now we need to edit the `sudoers` file. `Sudoers` is a file that allows regular users to run commands as "root" as long as an entry is placed correctly in the file. 
- "Your-new-user" and "griffin" both need to be added:
    - A comprehensive tutorial about sudoers is available [Here](https://help.ubuntu.com/community/Sudoers).
    - Or [here](https://www.digitalocean.com/community/tutorials/how-to-edit-the-sudoers-file-on-ubuntu-and-centos)
    - Shortcut version:
        - (As root) $ nano /etc/sudoers
        - Edit sudoers and add two lines using the following example:

```txt
# User privilege specification
root	            ALL=(ALL:ALL) ALL

# Add yourself:
your-new-username 	ALL=(ALL:ALL) ALL

# Add me:
griffin 	        ALL=(ALL:ALL) ALL
```

#### E. Basic necessary packages:

```bash
# update the package repositories
$ sudo apt-get update

# actually update any out of data packages
$ sudo apt-get upgrade

# install git a distributed version control system  
$ sudo apt-get install git

```

#### F. Testing Your Server

- Go to http://your.ip.address/ and see if the apache default page shows up.



