# K4-System-Website
This is a simple website that displays information from the K4-System plugin database. Currently, the plugin only provides rank, stats, time, and only these are displayed on the website. We will implement bans/mutes when the (Basic) Admins plugin becomes available through SQL.

# Dependencies
The default website operates with the database from the K4-System plugin: [K4-System](https://github.com/K4ryuu/K4-System)

# Installation
To modify the connection to the database, you need to edit the file src/connection.php. (If you have configured the K4-System plugin and it is functioning within normal parameters, then you can find the connection information in the CS2 server at: counterstrikesharp/configs/plugins/K4-System/K4-System.json.)

# Additional edits
You can make other manual modifications, such as changing the server's IP, which can be done in the header.php and index.php pages that you can modify as you wish.
Don't forget to change the description, title, and meta tags for each page (index, rank, time, stats, etc.)

For assistance, you can contact me on [Discord](https://discord.gg/Ebr62RJRd4). 

# Screenshot
![2](https://github.com/sdg12321/K4-System-Website/assets/151413805/b65f4f23-42aa-4d58-ae02-7d3001fc9fe7)
