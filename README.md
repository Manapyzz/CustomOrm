**Custom Orm**

**1) Installation**

- First you need to git clone this project.

- Then you need to give access to your database in the file "Database.php" in the databaseManager folder.

You now have a properly working environment ! :D 

**2) Get Started**

You can now run queries on your project: 

In your "index.html" just connect to your database by making this :

`$database = new databaseManager\DbTable();`

Select the table you want:

`$table = $database->selectTable('tableName')`;

Now you can access to all queries:

`$table->findAll()`;

! Note : You can do these step a little quicker by doing this:
 
`$result = $database->selectTable('movie')->findAll();`

**3) Generator**

If you want to generate some entities from your database, it's possible with this orm.

Just run this in your shell:

`php command/classGeneratorCommand.php`

Your entity will be generated in the entity folder.