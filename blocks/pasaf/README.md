H1 Pasaf block
A Moodle block specific to Pasaf Grade Report page. You can edit (as html) what shows up in the body of the block.

You can put the block, and see it, on the Edit Category Settings page ( course/editcategory.php ) fro a course category, and the Pasaf Grade Report page for a course. If you put it on both, with the course being inside the course category, you'll see the content added on the Edit Category Settings page's block in teh block on the Pasaf Grade Report page, *by design*. 

* The block is editable by managers.
* The block allows a manager to add html content to the block.
* The bock can be added to the Pasaf Grade Report page.
* The block can be added to the Edit Category Settings page ( course/editcategory.php )
* If added to the the Pasaf Grade Report page, the block is seen by all who can see that page.
* The block is used in conjunction with the Pasaf Grade Report plugin, but is not required by it.
* If added to the Edit Category Settings page, any block added to a Pasaf Grade Report page for a course within that specific category will have its content replaced by the content on the Edit Category Settings page's block.
* The block content can differ between course categories, but will remain the same within a course category, if the course category has a Pasaf block on its Edit Category Settings page. Every student in a course in that category will see the same block content, if the Pasaf block has been added on the course's category's Edit Category Settings page, and if a Pasaf block has been added to the course's Pasaf Grade Report page.
* If a course has a Pasaf block added to its Pasaf Grade Report page, but a Pasaf block hasn't been added to the course's category's Edit Category Settings page, all who can view the Pasaf Grade Report page will see the content of the Pasaf block that has been added to that course's Pasaf Grade Report page. If different courses in the same course category have Pasaf blocks, the block's content may well differ between courses. If a Pasaf block is then added to the courses' category's Edit Category Settings page, then all the course category's courses' Pasaf blocks will have the same content as the Edit Category Settings page's Pasaf block.
* If a course is in a category with a Pasaf block Edit Category Settings page, but the course has no Pasaf block on it's Pasaf Grade Report page, there won't be any Pasaf block content on the Pasaf Grade Report page.
* Pasaf block position on the Pasaf Grade Report page is specified by the page's block, *not* the course's category's Pasaf block (if it exists.)