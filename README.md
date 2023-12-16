<img alt="GitHub release (with filter)" src="https://img.shields.io/github/v/release/sdg12321/K4-System-Website"> <img alt="GitHub License" src="https://img.shields.io/github/license/sdg12321/K4-System-Website"> <img alt="GitHub Stars" src="https://img.shields.io/github/stars/sdg12321/K4-System-Website">
 <img alt="GitHub all releases" src="https://img.shields.io/github/downloads/sdg12321/K4-System-Website/total"> <img alt="GitHub Last Comit" src="https://img.shields.io/github/last-commit/sdg12321/K4-System-Website">
# Website for K4-System and CS2-SimpleAdmin
This is a simple website that displays information from the K4-System and CS2-SimpleAdmin plugin database. Currently, the plugin only provides rank, stats, time, bans, muted and only these are displayed on the website.

A responsive and pleasing design for a mobile.

# Dependencies
K4-System plugin: [K4-System](https://github.com/K4ryuu/K4-System)

CS2-SimpleAdmin plugin: [CS2-SimpleAdmin](https://github.com/daffyyyy/CS2-SimpleAdmin)

Either one or both, depending on whether you want to use the site for just one plugin from these two.

# Installation

- Download the last version of website: [releases](https://github.com/sdg12321/K4-System-Website/releases). If you wish to use only the pages for k4system, then unzip the k4system.zip archive using the 'extract here' option or by dragging the files into the same folder as the archive; do not create another folder. If you only want the pages for simpleadmin, then follow the same steps above for the simpleadmins.zip archive. If you want both, follow the same steps above for both archives.

- To modify the connection to the database for k4system, you need to edit the file **src/k4con.php**. (If you have configured the K4-System plugin and it is functioning within normal parameters, then you can find the connection information in the CS2 server at: counterstrikesharp/configs/plugins/K4-System/K4-System.json.)

- To modify the connection to the database for CS2-SimpleAdmin, you need to edit the file **src/simpleadmincon.php**. (If you have configured the CS2-SimpleAdmin plugin and it is functioning within normal parameters, then you can find the connection information in the CS2 server at: counterstrikesharp/configs/plugins/CS2-SimpleAdmin/CS2-SimpleAdmin.json.)

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
If you are using both plugins, then the modifications need to be made in both connection files for k4system and simpleadmin. Making changes in one part does not automatically apply to the other part.

# Additional edits
You modify the Discord invitation in **discord.php**.

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
- [x] To implement connecting multiple servers.
- [x] Bans / Gags (CS2-SimpleAdmin)
- [ ] List of Admins

# Screenshot
You can see the live website here: [toplay.ro](https://toplay.ro/)

![site](https://github.com/sdg12321/K4-System-Website/assets/151413805/54bd1d5a-ea1a-4ff6-a0a4-e55631362e04)
