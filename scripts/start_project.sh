#!/bin/bash

# Start the Laravel Sail environment in detached mode
./vendor/bin/sail up -d

# Run database migrations
./vendor/bin/sail artisan migrate
