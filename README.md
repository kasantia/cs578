# How to use
## Create subscription - POST request
#### Intended to be used by extension.

Required fields:
+ userid
+ url
+ elementid
+ elementclass
+ elementname
+ currentvalue
+ update = 0
+ delete = 0

Send POST request to: http://sample-env-1.cegpykp7aq.us-east-1.elasticbeanstalk.com/

## Request update - GET request
#### Intended to be used by extension.

Required field:
+ userid

ex: Get update for subscriptions of user 1 given database below

Request: http://sample-env-1.cegpykp7aq.us-east-1.elasticbeanstalk.com/?userid=1
<pre>
+------+--------------------------------------------------+---------+------------+-----------+--------+
|userid|  url                                             |elementid|currentvalue|elementname|modified|
+------+--------------------------------------------------+---------+------------+-----------+--------+
| 1    |http://www-scf.usc.edu/~hsinmaow/finding_neno.html|tres     |there       |p          |     1  |
+------+--------------------------------------------------+---------+------------+-----------+--------+
</pre>
Resulting JSON: 
{"modified":"true","0":{"url":"http:\/\/www-scf.usc.edu\/~hsinmaow\/finding_neno.html","elementid":"tres"}}

After the changed subscriptions are identified, the modified fields of those subscriptions will be set back to 0.
<pre>
+------+--------------------------------------------------+---------+------------+-----------+--------+
|userid|  url                                             |elementid|currentvalue|elementname|modified|
+------+--------------------------------------------------+---------+------------+-----------+--------+
| 1    |http://www-scf.usc.edu/~hsinmaow/finding_neno.html|tres     |there       |p          |     0  |
+------+--------------------------------------------------+---------+------------+-----------+--------+
</pre>

## Delete subscription - POST request
#### Intended to be used by extension.

Required fields:
+ userid
+ url
+ elementid
+ delete = 1
+ update = 0

Send POST request to: http://sample-env-1.cegpykp7aq.us-east-1.elasticbeanstalk.com/

## Update Modified - POST request
#### Intended to be used by backend.

This will set the "modified" value to 1 of the given subscription and update the current value. 

Required fields:
+ update = 1
+ subscriptionid
+ newValue

Send POST request to: http://sample-env-1.cegpykp7aq.us-east-1.elasticbeanstalk.com/
