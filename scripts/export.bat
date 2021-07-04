@echo off
rmdir ..\export /s /q
 xcopy ..\..\neowise ..\..\neowise-temp\ /s /e /v /y /exclude:ignore-copy.txt
 if not exist ..\export mkdir ..\export
 move ..\..\neowise-temp ..\export\neowise
 tar -a -c -f ..\export\neowise.zip ..\export\neowise
 rem rmdir ..\export\neowise /s /q