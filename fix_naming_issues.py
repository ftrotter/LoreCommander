#!/usr/bin/env python3
"""
Fix all naming violations for DURCC and ZZermelo.

Rules:
- DURC (single C) should be DURCC (double C) - except for DURC_ database names
- Zermelo (single Z) should be ZZermelo (double Z)
- zermelo (single z) should be zzermelo (double z)
"""

import os
import re

def fix_file(filepath):
    """Fix naming issues in a file. Returns True if file was modified."""
    
    # Skip binary files and git directory
    if '.git' in str(filepath):
        return False
    
    try:
        with open(filepath, 'r', encoding='utf-8', errors='ignore') as f:
            original_content = f.read()
    except Exception as e:
        print(f"Error reading {filepath}: {e}")
        return False
    
    content = original_content
    
    # Use regex with negative lookahead/lookbehind for precise matching
    
    # Fix DURC -> DURCC but preserve DURC_ (database names) and already-correct DURCC
    # Match DURC not followed by C and not followed by _
    content = re.sub(r'DURC(?!C)(?!_)', 'DURCC', content)
    
    # Fix Zermelo -> ZZermelo but preserve already-correct ZZermelo
    # Match Zermelo not preceded by Z
    content = re.sub(r'(?<!Z)Zermelo', 'ZZermelo', content)
    
    # Fix zermelo -> zzermelo but preserve already-correct zzermelo
    # Match zermelo not preceded by z
    content = re.sub(r'(?<!z)zermelo', 'zzermelo', content)
    
    # Check if anything changed
    if content != original_content:
        try:
            with open(filepath, 'w', encoding='utf-8') as f:
                f.write(content)
            print(f"Fixed: {filepath}")
            return True
        except Exception as e:
            print(f"Error writing {filepath}: {e}")
            return False
    
    return False

def fix_directory(directory):
    """Fix all files in a directory."""
    fixed_count = 0
    
    extensions = ['.php', '.json', '.md', '.txt']
    
    for root, dirs, files in os.walk(directory):
        # Skip .git directories
        dirs[:] = [d for d in dirs if d != '.git']
        
        for filename in files:
            if any(filename.endswith(ext) for ext in extensions) or '.blade.php' in filename:
                filepath = os.path.join(root, filename)
                if fix_file(filepath):
                    fixed_count += 1
    
    return fixed_count

def main():
    # Fix both DURCC and ZZermelo directories
    dirs_to_fix = [
        '/Users/ftrotter/gitgov/ftrotter/Lore/DURCC',
        '/Users/ftrotter/gitgov/ftrotter/Lore/ZZermelo'
    ]
    
    total_fixed = 0
    
    for directory in dirs_to_fix:
        if os.path.exists(directory):
            print(f"\n=== Fixing {directory} ===")
            count = fix_directory(directory)
            total_fixed += count
            print(f"Fixed {count} files in {directory}")
    
    print(f"\n\nTotal files fixed: {total_fixed}")

if __name__ == '__main__':
    main()
