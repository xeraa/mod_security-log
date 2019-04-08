# ModSecurity & Logging

Demo code for the talk [Hands-On ModSecurity and Logging](https://speakerdeck.com/xeraa/hands-on-modsecurity-and-logging). **This is insecure and generally bad code — only use it for demos and education on what not to do.**



## Features

1. Show [https://xeraa.wtf](https://xeraa.wtf) and then specifically [https://xeraa.wtf/read.php?id=1](https://xeraa.wtf/read.php?id=1) — this looks potentially interesting, right?
1. Validate the suspicion with `sqlmap --url "https://xeraa.wtf/read.php?id=1" --purge`. This assumes you have installed sqlmap (for example with Homebrew), otherwise download and run it with `python sqlmap.py`.
1. So this has potential. Quickly show the code with a focus on the string concatenation and `mysqli_multi_query`.
1. Exploit the bad code by attaching `;INSERT INTO employees (name) VALUES ('Philipp')` to [https://xeraa.wtf/read.php?id=1](https://xeraa.wtf/read.php?id=1).
1. Also we are not escaping the output, so `;INSERT INTO employees (id,name,city,salary) VALUES (5,'<script>alert("hello")</script>','evil',0)` will add more fun to the demo.
1. Dive into the logging by showing */var/log/app.log* and then how Filebeat is collecting this information.
1. In Kibana show the relevant parts either in Discover or the Log UI by filtering down to `application : "app"`.
1. Try to `DELETE` or `DROP` data for example with `;DROP TABLE employees`, which doesn't work since our connection only allows `SELECT` or `INSERT`.
1. Point to [https://xeraa.wtf:8080](https://xeraa.wtf:8080), which is using the same code but runs on Apache and ModSecurity instead of nginx.
1. Run `sqlmap --url "https://xeraa.wtf:8080/read.php?id=1" --purge`, which results in `403 (Forbidden) - 134 times`.
1. Show the Apache Filebeat dashboard where you can see the blocked requests.
1. Also show the raw ModSecurity logs by filtering to `application : "mod_security"` and point out that JSON logging is the important configuration here as well as the `rename` to the `message` field.



## Setup

Make sure you have run this before the demo.

1. Have your AWS account set up, access key created, and added as environment variables in `AWS_ACCESS_KEY_ID` and `AWS_SECRET_ACCESS_KEY`. Protip: Use [https://github.com/sorah/envchain](https://github.com/sorah/envchain) to keep your environment variables safe.
1. Create the Elastic Cloud instance with the same version as specified in *variables.yml*'s `elastic_version`, enable Kibana as well as the GeoIP & user agent plugins, and set the environment variables with the values for `ELASTICSEARCH_HOST`, `ELASTICSEARCH_USER`, `ELASTICSEARCH_PASSWORD`, as well as `KIBANA_HOST`, `KIBANA_ID`.
1. Change the settings to a domain you have registered under Route53 in *inventory*, *variables.tf*, and *variables.yml*. Set the Hosted Zone for that domain and export the Zone ID under the environment variable `TF_VAR_zone_id`. If you haven't created the Hosted Zone yet, you should set it up in the AWS Console first and then set the environment variable.
1. If you haven't installed the AWS plugin for Terraform, get it with `terraform init` first. Then create the keypair, DNS settings, and instances with `terraform apply`.
1. Open HTTPS and TCP/8080 on the network configuration (waiting for this [Terraform issue](https://github.com/terraform-providers/terraform-provider-aws/issues/700)).
1. Apply the configuration to the instance with `ansible-playbook configure.yml`.

When you are done, remove the instances, DNS settings, and key with `terraform destroy`.



## Todo

* Add `' or true -- ` to skip the login form and add it to the flow (probably first)
* Add custom ModSecurity rule — maybe filter out Shay in POST requests: https://www.digitalocean.com/community/tutorials/how-to-set-up-mod_security-with-apache-on-debian-ubuntu
* Add sqlmap for the login page: https://github.com/sqlmapproject/sqlmap/wiki/Usage
