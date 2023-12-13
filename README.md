<img alt="GitHub release (with filter)" src="https://img.shields.io/github/v/release/sdg12321/K4-System-Website"> <img alt="GitHub License" src="https://img.shields.io/github/license/sdg12321/K4-System-Website"> <img alt="GitHub Stars" src="https://img.shields.io/github/stars/sdg12321/K4-System-Website">
 <img alt="GitHub all releases" src="https://img.shields.io/github/downloads/sdg12321/K4-System-Website/total"> <img alt="GitHub Last Comit" src="https://img.shields.io/github/last-commit/sdg12321/K4-System-Website">
# K4-System-Website
This is a simple website that displays information from the K4-System plugin database. Currently, the plugin only provides rank, stats, time, and only these are displayed on the website. We will implement bans/mutes when the (Basic) Admins plugin becomes available through SQL.

A responsive and pleasing design for a mobile.

# Dependencies
The default website operates with the database from the K4-System plugin: [K4-System](https://github.com/K4ryuu/K4-System)

# Installation For Single Server
Download the last version of website for Single Server: [releases](https://github.com/sdg12321/K4-System-Website/releases)

To modify the connection to the database, you need to edit the file **src/connection.php**. (If you have configured the K4-System plugin and it is functioning within normal parameters, then you can find the connection information in the CS2 server at: counterstrikesharp/configs/plugins/K4-System/K4-System.json.)

# Installation For MultiServers

**STEP 1:** Download the last version of website for MultiServers: [releases](https://github.com/sdg12321/K4-System-Website/releases)

**STEP 2:** To modify the connection to the database, you need to edit the file **src/connection.php**. (If you have configured the K4-System plugin and it is functioning within normal parameters, then you can find the connection information in the CS2 server at: counterstrikesharp/configs/plugins/K4-System/K4-System.json.)

For each server, you need to add a unique name in the "case," such as "Server1," "Server2," etc. If you have two servers, you should have only two "cases" with the connection details for each. If you have three servers, you will have three "cases" with the connection details for each.

```
case 'Server1':
$hostname = "";
$port = "3306"; // Add the port corresponding to server 1
$username = "";
$password = "";
$database = "";
break;
```

**STEP 3:** In the serversmenu.php file, add the menu with the servers you configured in step 2.
The text "Server1" in "onclick="changeServer('Server1')" needs to be replaced with the name you entered in step 2. For each additional server, add a new line and replace the "Server1" with the name of the server you entered in step 2 and "NameServer1" with what you want.

The text "NameServer1" is the name that will be displayed on the website, meaning the button's label. Here, you can enter whatever you prefer, for example, "Zombie," "Classic," etc.

```
<div class="server-buttons">
<button class="server-button" onclick="changeServer('Server1')">NameServer1</button>
<button class="server-button" onclick="changeServer('Server2')">NameServer2</button>
<!-- Add other servers here if necessary -->
```

**STEP 4:** For both rank.php and time.php pages, you need to enter and modify the default page to be displayed when accessing rank.php or time.php. For example, if you have 3 servers - Zombie, Classic, and HNS - and when the website is accessed on the rank.php page, you want the first results to be displayed from the Classic server, modify where it says "Server1" with the name entered in the "case" from step 2. This needs to be modified in both sections of the following code and in both pages.

```
// Check if a server has been selected
$selectedServer = isset($_GET['server']) ? $_GET['server'] : 'Server1';

// If 'server' parameter is not set, redirect to the default server
if (!isset($_GET['server'])) {
    header("Location: ?server=Server1");
    exit();
}
```

# Additional edits
You modify the Discord invitation in **discord.php**.

You can make other manual modifications, such as changing the server's NAME and IP, which can be done in the header.php and index.php pages that you can modify as you wish.
Don't forget to change the description, title, and meta tags for each page (index, rank, time, stats, etc.)

Changing the colors of the ranks - **rank.php**

At the bottom of the page.

Change **'case'** with the rank name and **'return'** with the color name 'grey' or color code '#C0C0C0'.

To modify or delete, change only here, and it should look something like this. In the file, there are multiple ranks; you will see the difference to understand how to add/delete.
```
function getRankClass($rankName) {
    switch ($rankName) {

        case 'Bronze':
        return 'grey';

        case 'Silver':
        return '#C0C0C0';

        default:
        return '';
    }
}
```

For assistance, you can contact me on [Discord](https://discord.gg/XJEvUa9QfJ). 

# To Do list
- [x] To implement rank, stats, and hours played from k4-system.
- [ ] List of Admins / Bans / Gags (Waiting for the css-basic-admin database.)

# Screenshot
You can see the live website here: [toplay.ro](https://toplay.ro/)

![site](https://github.com/sdg12321/K4-System-Website/assets/151413805/54bd1d5a-ea1a-4ff6-a0a4-e55631362e04)
