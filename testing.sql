drop procedure test_stored_proc
go

create procedure test_stored_proc (@superfoo varchar(100), @output_param varchar(100) OUTPUT)
as
    select @output_param = "This is the output parameter"
    return 42
go

declare @op varchar(100)
exec test_stored_proc "This is a test input string", @output_param = @op OUTPUT
go
