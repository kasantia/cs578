# How to use
## Create subscription
Example of adding new subscription
Required fields:
+ id
+ url
+ elementid
+ currentvalue
+ request=new (this is to indicate that this is creating a new subscription)

http://sample-env-1.cegpykp7aq.us-east-1.elasticbeanstalk.com/?request=new&url=www.usc.edu&elementid=test&currentvalue=value&elementname=test&userid=2

As a result, the database will have added a new subscription
<pre>
+------+--------------------------------------------------+---------+------------+-----------+--------+
|userid|  url                                             |elementid|currentvalue|elementname|modified|
+------+--------------------------------------------------+---------+------------+-----------+--------+
| 1    |http://www-scf.usc.edu/~hsinmaow/finding_neno.html|tres     |there       |p          |     1  |
| 2    |www.usc.edu                                       |test     |value       |test       |     0  |
+------+--------------------------------------------------+---------+------------+-----------+--------+
</pre>

## Request update
Give id of user you want update for
ex: Get update for subscriptions of user 1 given database below

http://sample-env-1.cegpykp7aq.us-east-1.elasticbeanstalk.com/?userid=1
<pre>
+------+--------------------------------------------------+---------+------------+-----------+--------+
|userid|  url                                             |elementid|currentvalue|elementname|modified|
+------+--------------------------------------------------+---------+------------+-----------+--------+
| 1    |http://www-scf.usc.edu/~hsinmaow/finding_neno.html|tres     |there       |p          |     1  |
+------+--------------------------------------------------+---------+------------+-----------+--------+
</pre>
Resulting JSON: 
{"modified":"true","0":{"url":"http:\/\/www-scf.usc.edu\/~hsinmaow\/finding_neno.html","elementid":"tres"}}