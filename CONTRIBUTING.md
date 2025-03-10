# Contributing Guidelines

## Version Control Rules

### 1. Versioning Format
We use Semantic Versioning (MAJOR.MINOR.PATCH):
- MAJOR version for incompatible API changes (e.g., 2.0.0)
- MINOR version for new functionality in a backward compatible manner (e.g., 1.1.0)
- PATCH version for backward compatible bug fixes (e.g., 1.0.1)

### 2. Development Workflow

#### Before Starting Development:
1. Create a new branch from `main`:
   ```bash
   git checkout -b feature/widget-name
   # or
   git checkout -b fix/issue-description
   ```

2. Update version numbers in:
   - `hello-elementor-widgets.php`
   - `readme.txt`

#### During Development:
1. Keep commits small and focused
2. Use descriptive commit messages:
   ```bash
   git commit -m "feat: Add new team member widget"
   # or
   git commit -m "fix: Resolve gallery layout issues"
   ```

#### Before Pushing Changes:
1. Update changelog in `readme.txt`:
   ```
   == Changelog ==
   
   = 1.1.0 =
   * Added: New Team Member widget
   * Fixed: Gallery layout responsiveness
   ```

2. Test widget functionality
3. Run code linting if available

### 3. Version Update Checklist

#### For New Features (MINOR version update):
- [ ] Increment MINOR version (e.g., 1.0.0 → 1.1.0)
- [ ] Add new feature description to changelog
- [ ] Update plugin version in main file
- [ ] Test new feature
- [ ] Update documentation if needed

#### For Bug Fixes (PATCH version update):
- [ ] Increment PATCH version (e.g., 1.0.0 → 1.0.1)
- [ ] Add bug fix description to changelog
- [ ] Update plugin version in main file
- [ ] Test fix implementation

#### For Breaking Changes (MAJOR version update):
- [ ] Increment MAJOR version (e.g., 1.0.0 → 2.0.0)
- [ ] Document all breaking changes
- [ ] Update plugin version in main file
- [ ] Update documentation
- [ ] Test backward compatibility issues

### 4. Release Process

1. Merge feature branch to main
2. Create a new release on GitHub:
   - Tag: v1.1.0
   - Title: Version 1.1.0
   - Description: Copy changelog entries
3. Upload ZIP file containing the new version

### 5. File Update Locations

When updating version, modify these files:
```
hello-elementor-widgets/
├── hello-elementor-widgets.php  # Update VERSION constant
├── readme.txt                   # Update Stable tag & Changelog
└── package.json                 # If using npm/node
```

### 6. Commit Message Format

Use conventional commits format:
- `feat: Add new feature`
- `fix: Fix bug`
- `docs: Update documentation`
- `style: Format code`
- `refactor: Restructure code`
- `test: Add tests`
- `chore: Update build tasks`

### 7. Branch Naming Convention

- Feature branches: `feature/widget-name`
- Bug fix branches: `fix/issue-description`
- Documentation: `docs/description`
- Release branches: `release/1.1.0`

## Code Style Guidelines

### PHP
- Follow WordPress Coding Standards
- Use PSR-4 autoloading
- Document all classes and methods

### CSS
- Use BEM naming convention
- Prefix all classes with widget name
- Keep selectors specific to avoid conflicts

### JavaScript
- Use ES6+ features
- Namespace all functions
- Use strict mode 