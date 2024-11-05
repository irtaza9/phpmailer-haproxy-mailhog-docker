# PHPMailer with HAProxy and MailHog Setup

This project demonstrates how to set up **PHPMailer** to send emails through a load-balanced SMTP setup using **HAProxy** and **MailHog** in Docker. This configuration helps test email delivery with redundancy and load balancing.

## Table of Contents
- [Overview](#overview)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Usage](#usage)
- [Troubleshooting](#troubleshooting)

## Overview

This project includes:
- **PHPMailer**: A PHP library for sending emails.
- **HAProxy**: A load balancer that distributes email sending between multiple SMTP servers.
- **MailHog**: A mock SMTP server for email testing. Emails sent to MailHog are captured and accessible through a web UI.

## Prerequisites

- **Docker**: Make sure Docker is installed on your machine.
- **Docker Compose**: To orchestrate multiple Docker containers.

## Installation

1. **Clone the Repository**:
   ```bash
   git clone [repo](https://github.com/irtaza9/phpmailer-haproxy-mailhog-docker.git)
   cd phpmailer-haproxy-mailhog-docker

2. **Build and Start Containers**:
    ```bash 
    docker-compose up --build
3. **Access MailHog Web UIs**:
    - [MailHog1](http://localhost:8025)
    - [MailHog2](http://localhost:8026)

## Usage

1. **Send a Test Email**: Trigger the test script by visiting `http://localhost:8080/index.php` in a browser or using `curl`:

    ```plaintext
    curl http://localhost:8080/index.php
2. **View Captured Emails**: Check the MailHog web UIs to see the emails sent by PHPMailer.

## Query Parameters

The `index.php` script can be modified to accept query parameters for troubleshooting email and check the load. Here are some possible parameters:

- **number**: Specifies the total number of emails to send. Useful for simulating high load and testing HAProxy’s load balancing.
- **limit**: Limits the number of emails sent in one batch or session. Helps control the volume for testing without overwhelming resources.
- **debug**: Enables detailed debug output if set to `true`. This can be used to view SMTP connection details, check which MailHog server is processing the emails, and troubleshoot any issues.

### Example Usage

To test sending emails with custom parameters, you can access the script via URL:

```plaintext
http://localhost:8080/index.php?number=10&limit=5&debug=true