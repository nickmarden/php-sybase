<?
    $dbh = sybase_pconnect("SERVER", "user", "password");
    if(!$dbh) {
        echo("<B>Unable to connect to database.</B><BR>\n");
        exit;
    }

    $sql = "
        declare @op varchar(100)
        exec test_stored_proc 'This is the input string',
                              @output_param = @op OUTPUT
    ";
    $result = sybase_query($sql);

    if(!$result) {
        echo("<B>Unable to execute $sql.<B><BR>\n");
        exit;
    }

    // Create a table of output parameters
    echo("<table><tr><th bgcolor=grey>Output parameter</th><th>Value</th></tr>\n");
    $output_params = sybase_output_params($result->_queryID);
    while(list($key, $value) = each($output_params))
    {
        echo("<tr><td>$key</td><td>$value</td></tr>\n");
    }
    echo("</table>\n");

    echo("<br/>Return value is " . sybase_return_status($result->_queryID));

?>
