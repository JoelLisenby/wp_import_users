# wp_import_users
A simple function to import users from a CSV file into WordPress. Also has the
ability to add the imported users to a group by group name. If applicable you
can add as many custom meta data columns as you want by modifying the function.

## CSV Format Requirements
**Note:** the function will ignore the first row so you can safely leave your column
headings in the csv file.

### Example CSV
* **Custom Meta Data Columns:** phone, fax
* **Group Column:** group

```
first_name,last_name,email,title,phone,fax,role,group
John,Doe,john.doe@gmail.com,Employee,5555555555,5555555555,author,ACME Employees
```
## Import Custom User Meta Data
The function has the ability to add custom meta data to users ready to use by
uncommenting the respective lines in the function.

## Insert Users Into Groups
Group import is for itthinx Groups plugin. https://wordpress.org/plugins/groups/

Just uncomment the respective lines in the function to import the users into
the group and list the group name in the CSV file.

## Function usage
1. Upload your properly formatted CSV file to your active theme directory.
2. Add the function to your theme's ```functions.php``` file.
3. Adjust the file name.
4. Uncomment optional features (custom meta data, group insertion)
5. Uncomment the function call at the bottom
6. Load any page while logged in as super admin.

**Once you are done, be sure to remove or recomment the function call as it will
slow the site down while running and throw errors once the users have been imported.**
