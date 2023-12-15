<img alt="GitHub release (with filter)" src="https://img.shields.io/github/v/release/sdg12321/K4-System-Website"> <img alt="GitHub License" src="https://img.shields.io/github/license/sdg12321/K4-System-Website"> <img alt="GitHub Stars" src="https://img.shields.io/github/stars/sdg12321/K4-System-Website">
 <img alt="GitHub all releases" src="https://img.shields.io/github/downloads/sdg12321/K4-System-Website/total"> <img alt="GitHub Last Comit" src="https://img.shields.io/github/last-commit/sdg12321/K4-System-Website">
# K4-System-Website
This is a simple website that displays information from the K4-System plugin database. Currently, the plugin only provides rank, stats, time, and only these are displayed on the website. We will implement bans/mutes when the (Basic) Admins plugin becomes available through SQL.

A responsive and pleasing design for a mobile.

# Dependencies
The default website operates with the database from the K4-System plugin: [K4-System](https://github.com/K4ryuu/K4-System)

# Installation

**STEP 1:** Download the last version of website for MultiServers: [releases](https://github.com/sdg12321/K4-System-Website/releases)

**STEP 2:** To modify the connection to the database, you need to edit the file **src/connection.php**. (If you have configured the K4-System plugin and it is functioning within normal parameters, then you can find the connection information in the CS2 server at: counterstrikesharp/configs/plugins/K4-System/K4-System.json.)

For each server, you need to add a unique name such as 'server1', 'server2', 'cs2.toplay.ro', 'classic', 'AWP ONLY' etc.(What name do you want, but not two with the same name). Add or remove as many servers as needed. If you have only one, then delete the rest of servers and leave only one.

```
'server1' => [
        'hostname' => '',
        'port' => '3306',
        'username' => '',
        'password' => '',
        'database' => '',
        'prefix' => ''
    ],
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
