# ModSecurity & Logging




## Features


`python sqlmap.py --url "https://xeraa.wtf/read.php?id=1" --purge`

`;INSERT INTO employees (id,name,city,salary) VALUES (4,'test','test',10000)`

`;INSERT INTO employees (id,name,city,salary) VALUES (5,'<script>alert("hello")</script>','evil',0)`

`;DELETE FROM employees WHERE ID=1`



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

* Add custom ModSecurity rule
* Readme
