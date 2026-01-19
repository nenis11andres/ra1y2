# Región AWS
variable "aws_region" {
  description = "Región AWS donde se crearán los recursos"
  type        = string
  default     = "us-east-1"
}



variable "apache_ami" {
  description = "AMI ID para Debian"
  type        = string
  default     = "ami-0b0012dad04fbe3d7" # Debian 12 en us-east-1
}

# Tipo de instancia
variable "instance_type" {
  description = "Tipo de instancia EC2"
  type        = string
  default     = "t2.micro"
}



variable "key_name2" {
  description = "Nombre del key pair para SSH"
  type        = string
  default     = "apache2" 
}