#!/bin/bash

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m'

# Current version from hello-elementor-widgets.php
CURRENT_VERSION=$(grep "const VERSION = '" hello-elementor-widgets.php | cut -d"'" -f2)

echo -e "${YELLOW}Current version: $CURRENT_VERSION${NC}"
echo "Enter new version number (e.g., 1.1.0):"
read NEW_VERSION

# Validate version number format
if [[ ! $NEW_VERSION =~ ^[0-9]+\.[0-9]+\.[0-9]+$ ]]; then
    echo -e "${RED}Invalid version number format. Please use semantic versioning (e.g., 1.0.0)${NC}"
    exit 1
fi

echo "Enter changelog entry:"
read CHANGELOG_ENTRY

# Update version in hello-elementor-widgets.php
sed -i "s/const VERSION = '$CURRENT_VERSION'/const VERSION = '$NEW_VERSION'/" hello-elementor-widgets.php

# Update version in readme.txt
sed -i "s/Stable tag: $CURRENT_VERSION/Stable tag: $NEW_VERSION/" readme.txt

# Add new changelog entry in readme.txt
awk -v ver="$NEW_VERSION" -v entry="$CHANGELOG_ENTRY" '
/== Changelog ==/ {
    print
    print ""
    print "= " ver " ="
    print "* " entry
    print ""
    next
}
1
' readme.txt > readme.txt.tmp && mv readme.txt.tmp readme.txt

# Create git commit
git add hello-elementor-widgets.php readme.txt
git commit -m "chore: Bump version to $NEW_VERSION"

# Create git tag
git tag -a "v$NEW_VERSION" -m "Version $NEW_VERSION"

echo -e "${GREEN}Version updated to $NEW_VERSION${NC}"
echo -e "${GREEN}Don't forget to:${NC}"
echo "1. Push changes: git push origin main"
echo "2. Push tags: git push origin v$NEW_VERSION"
echo "3. Create a new release on GitHub" 