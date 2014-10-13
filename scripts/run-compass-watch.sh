#!/bin/sh
DIR="$( cd "$(dirname "${BASH_SOURCE[0]}" )" && pwd )"
compass watch $DIR/../ -c $DIR/compass/compass.rb
