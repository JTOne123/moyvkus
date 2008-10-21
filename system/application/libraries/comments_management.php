<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Comments_management {

        var $ci;

        function Comments_management()
        {
            $this->ci =& get_instance();
            $this->ci->load->database();
        }


        function SaveComment($text, $recipe_id, $user_id)
        {
            $query = $this->ci->db->query("INSERT INTO comments (text, recipe_id, user_id) VALUES('$text', '$recipe_id', '$user_id')");
            if($query)
            {
                return true;
            }
            else
            return false;
        }

        function GetCensorWords()
        {
            $query = $this->ci->db->query("SELECT word FROM word_censor");

            foreach ($query->result_array() as $row)
            {
                $word[] = $row['word'];
            }

            return $word;
        }

        function GetNumberOfComments($id_of_recipe)
        {
            $query = $this->ci->db->query("SELECT id FROM comments WHERE recipe_id=$id_of_recipe");
            return $query->num_rows();
        }

        function GetComments($id_of_recipe)
        {
            $query = $this->ci->db->query("SELECT * FROM comments WHERE recipe_id=$id_of_recipe ORDER BY id DESC");
            return $query->result_array();
        }

        function IsUserIsCommentAuthor($comment_id, $logened_user_id)
        {
            $query = $this->ci->db->query("SELECT user_id FROM comments WHERE id=$comment_id");
            $row = $query->row();

            if($row->user_id===$logened_user_id)
            {
                return true;
            }
            else
            return false;
        }
        
        function DeleteComment($id_of_comment)
        {
            $this->ci->db->query("DELETE FROM comments WHERE id=$id_of_comment");
        }

        function ViewCommentsBuilder()
        {
            return "<div id=\"FriendsItemNotConfirmed\" class=\"CommentsItem\">
                                <table cellpadding=\"0\" cellspacing=\"0\" class=\"FriendsItemTable\">
                                <tr>
                                <td valign=\"top\" class=\"FriendAvatarTD\">
                                <a href=\"{AuthorProfileUrl}\">
                                <img src=\"{AvatarUrl}\" title=\"{AuthorFirstLastName}\" class=\"FriendAvatar\"/>
                                </a>
                                </td>
                                <td valign=\"top\">
                                <table>
                                <tr>
                                <td class=\"LabelTextFriends\">
                                <a href=\"{AuthorProfileUrl}\">
                                <b>{AuthorFirstLastName}</b>
                                </a>
                                <span class=\"AdditionalText\">
                                {WriteOn}
                                {DateOfPost}
                                </span>
                                </td>
                                </tr>
                                
                                <tr>
                                <td class=\"LabelTextFriends\">
                                {CommentText}
                                </td>
                                </tr>
                                <tr>
                                <td>
                                <span class=\"AdditionalText\">
                                <a href=\"{DeleteRecipeLink}\">{DeleteRecipeLinkText}</a>
                                <a href=\"{SendMessageToCommentAuthor}\">{SendMessageToCommentAuthorText}</a>
                                </span>
                                </td>
                                </tr>
                                
                                </table>
                                </td>
                                
                                
                                </tr>
                                </table>
                                </div>";
        }
        
        function ViewMyNewsBuilder()
        {
            return "<div id=\"FriendsItemNotConfirmed\" class=\"CommentsItem\">
                                <table cellpadding=\"0\" cellspacing=\"0\" class=\"FriendsItemTable\">
                                <tr>
                                <td valign=\"top\" class=\"FriendAvatarTD\">
                                <a href=\"{RecipeUrl}\">
                                <img src=\"{RecipePhotoUrl}\" title=\"{RecipeName}\" class=\"FriendAvatar\"/>
                                </a>
                                </td>
                                <td valign=\"top\">
                                <table width=\"100%\">
                                <tr>
                                <td class=\"LabelTextFriends\">
                                <span class=\"AdditionalText\">
                                {AddCommentsText}
                                </span>
                                <a href=\"{RecipeUrl}\">
                                <b>{RecipeName}</b>
                                </a>
                                </td>
                                </tr>
                                <tr>
                                <td class=\"LabelTextFriends\">
                                {CommentText}
                                </td>
                                </tr>
                                <tr>
                                <td>
                                <br/>
                                </td>
                                </tr>
                                <tr>
                                <td align=\"center\">
                                <span class=\"AdditionalText\">
                                <a href=\"{AutherLink}\">{AutherAndTime}</a>
                                </span>
                                </td>
                                </tr>
                                </table>
                                </td>
                                </tr>
                                </table>
                                </div>";
        }
        
        function GetCommentedRecipes($user_id)
        {
            $query = $this->ci->db->query("SELECT DISTINCT recipe_id
                                               FROM comments
                                               WHERE user_id = $user_id
                                               ORDER BY timestamp DESC
                                               LIMIT 0, 30");
            return $query;
        }
        
        function GetCommentForRecipe($recipe_id)
        {
            $query = $this->ci->db->query("SELECT c.text, c.timestamp, c.user_id, r.name, r.photo_name
                                           FROM comments AS c
                                           LEFT JOIN recipes AS r ON r.id = c.recipe_id
                                           WHERE c.recipe_id = $recipe_id
                                           ORDER BY c.id DESC 
                                           LIMIT 0, 1");
            return $query->row();
        }
    }
?>