# Distributed Phone Directory System

A **school assignment** for the Distributed Systems course: a simple distributed application that manages a shared phone directory across three MySQL nodes. Built with PHP, MySQL and Apache, and connected over a virtual LAN created via Hamachi.

## Description

This project demonstrates a basic distributed database application. You can:

- **List** all phone records
- **Add**, **Edit** and **Delete** individual phone entries
- **Automatically synchronize** changes across three separate database nodes
- **Log failed transactions** and retry them on demand

Under the hood, each operation (INSERT, UPDATE, DELETE) is applied locally and propagated to the two remote nodes. If a remote update fails, the SQL statement is saved in `failed_transactions.txt`, and can be retried later with the “Sync Failed Transactions” function.

## Features

- **CRUD interface**: intuitive web forms for creating, reading, updating and deleting phone entries
- **Distributed replication**: uses three MySQL instances (local + two remote) to keep data in sync
- **Failure handling**: failed remote writes are logged and can be replayed
- **Virtual LAN setup**: nodes are networked via Hamachi so you don’t need any special cloud or VPN infrastructure
- **Self-contained**: all you need is PHP 7+, Apache (or another web server), MySQL and Hamachi