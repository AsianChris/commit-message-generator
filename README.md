# Commit Messages

Based on the work of [Nick Gerakines](https://github.com/ngerakines/commitment)

This is a Slim Application that generates random commit messages.

## Installation

```
$ git clone https://github.com/AsianChris/commit-message-generator.git commit-message-generator
$ cd commit-message-generator
$ composer install
$ chmod 777 -R storage/*
```

## Usage

You can grab a random commit message in plain text at `http://watdagit.com/commit-message.txt`

This URL would allow you to create a git alias that will make a commit with a random commit message

```
$ git config --global alias.omg '!git commit -m "$(curl -s watdagit.com/commit-message.txt)"'
```

So everytime you need to make a commit, you can run

```
$ git omg
```
