#!/usr/bin/env python3
"""
Find all files with naming violations for DURCC and ZZermelo.

Rules:
- DURC should always be DURCC (two C's)
- Zermelo should always be ZZermelo (two Z's) - but only when referring to the package, not database names like DURC_northwind
- CareSet should always be "Care Set" (two words) in documentation
"""

import os
import re
from pathlib import Path

def scan_file(filepath):
    """Scan a file for naming violations. Returns list of (line_num, issue, line_content)"""
    issues = []
    
    # Skip binary files and git directory
    if '.git' in str(filepath):
        return issues
    
    try:
        with open(filepath, 'r', encoding='utf-8', errors='ignore') as f:
            content = f.read()
            lines = content.split('\n')
    except:
        return issues
    
    for line_num, line in enumerate(lines, 1):
        # Check for DURC not followed by C (i.e., single C DURC)
        # But exclude DURC_ which is a database naming convention
        # Match DURC followed by non-C character or end, but not DURC_
        durc_matches = re.finditer(r'DURC(?!C|_)', line)
        for match in durc_matches:
            issues.append((line_num, 'DURC should be DURCC', line.strip()[:100]))
        
        # Check for single Z Zermelo (not preceded by Z and not followed by anything that makes it ZZermelo)
        # Match Zermelo not preceded by Z
        zermelo_matches = re.finditer(r'(?<!Z)Zermelo', line)
        for match in zermelo_matches:
            issues.append((line_num, 'Zermelo should be ZZermelo', line.strip()[:100]))
        
        # Check for lowercase zermelo not preceded by z
        zermelo_lower_matches = re.finditer(r'(?<!z)zermelo', line)
        for match in zermelo_lower_matches:
            issues.append((line_num, 'zermelo should be zzermelo', line.strip()[:100]))
        
        # Check for CareSet (should be "Care Set" in docs, but namespace should use ftrotter)
        # In PHP/JSON namespace context, CareSet\ is wrong
        if re.search(r'CareSet\\', line):
            issues.append((line_num, 'CareSet\\ namespace should be ftrotter\\', line.strip()[:100]))
    
    return issues

def scan_directory(directory):
    """Scan a directory for all files with naming issues."""
    results = {}
    
    extensions = ['.php', '.json', '.md', '.blade.php', '.txt']
    
    for root, dirs, files in os.walk(directory):
        # Skip .git directories
        dirs[:] = [d for d in dirs if d != '.git']
        
        for filename in files:
            if any(filename.endswith(ext) for ext in extensions):
                filepath = os.path.join(root, filename)
                issues = scan_file(filepath)
                if issues:
                    results[filepath] = issues
    
    return results

def main():
    # Scan both DURCC and ZZermelo directories
    dirs_to_scan = [
        '/Users/ftrotter/gitgov/ftrotter/Lore/DURCC',
        '/Users/ftrotter/gitgov/ftrotter/Lore/ZZermelo'
    ]
    
    all_issues = {}
    
    for directory in dirs_to_scan:
        if os.path.exists(directory):
            print(f"\n=== Scanning {directory} ===")
            results = scan_directory(directory)
            all_issues.update(results)
            
            for filepath, issues in results.items():
                print(f"\n{filepath}:")
                for line_num, issue, content in issues:
                    print(f"  Line {line_num}: {issue}")
                    print(f"    {content}")
    
    # Write results to a file for the fixer script
    with open('/Users/ftrotter/gitgov/ftrotter/Lore/LoreCommander/naming_issues.txt', 'w') as f:
        for filepath in all_issues.keys():
            f.write(f"{filepath}\n")
    
    print(f"\n\nTotal files with issues: {len(all_issues)}")
    print("List of files written to naming_issues.txt")

if __name__ == '__main__':
    main()
