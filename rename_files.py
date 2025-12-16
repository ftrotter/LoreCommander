#!/usr/bin/env python3
"""
Rename all files that have DURC (single C) to DURCC (double C)
and Zermelo (single Z) to ZZermelo (double Z).
"""

import os
import subprocess

def rename_files_in_directory(directory):
    """Find and rename files with naming issues."""
    renames = []
    
    for root, dirs, files in os.walk(directory):
        # Skip .git
        dirs[:] = [d for d in dirs if d != '.git']
        
        for filename in files:
            old_path = os.path.join(root, filename)
            new_filename = filename
            
            # Fix DURC -> DURCC in filename (but not DURC_ database prefix)
            # Check if DURC is followed by non-C
            if 'DURC' in new_filename and 'DURCC' not in new_filename and 'DURC_' not in new_filename:
                new_filename = new_filename.replace('DURC', 'DURCC')
            
            # Fix Zermelo -> ZZermelo in filename
            if 'Zermelo' in new_filename and 'ZZermelo' not in new_filename:
                new_filename = new_filename.replace('Zermelo', 'ZZermelo')
            
            # Fix zermelo -> zzermelo in filename (lowercase)
            if 'zermelo' in new_filename and 'zzermelo' not in new_filename:
                new_filename = new_filename.replace('zermelo', 'zzermelo')
            
            if new_filename != filename:
                new_path = os.path.join(root, new_filename)
                renames.append((old_path, new_path, root))
    
    return renames

def main():
    dirs_to_process = [
        '/Users/ftrotter/gitgov/ftrotter/Lore/DURCC',
        '/Users/ftrotter/gitgov/ftrotter/Lore/ZZermelo'
    ]
    
    all_renames = []
    
    for directory in dirs_to_process:
        if os.path.exists(directory):
            renames = rename_files_in_directory(directory)
            all_renames.extend(renames)
    
    if not all_renames:
        print("No files need renaming.")
        return
    
    print(f"Found {len(all_renames)} files to rename:\n")
    for old_path, new_path, root in all_renames:
        print(f"  {os.path.basename(old_path)} -> {os.path.basename(new_path)}")
    
    print("\nRenaming files using git mv...")
    
    for old_path, new_path, root in all_renames:
        # Change to the git root for git mv
        git_root = root
        while git_root != '/':
            if os.path.exists(os.path.join(git_root, '.git')):
                break
            git_root = os.path.dirname(git_root)
        
        try:
            # Use git mv to preserve history
            result = subprocess.run(
                ['git', 'mv', old_path, new_path],
                cwd=git_root,
                capture_output=True,
                text=True
            )
            if result.returncode == 0:
                print(f"  Renamed: {os.path.basename(old_path)} -> {os.path.basename(new_path)}")
            else:
                print(f"  Error renaming {old_path}: {result.stderr}")
        except Exception as e:
            print(f"  Exception renaming {old_path}: {e}")
    
    print("\nDone! Now commit and push the changes.")

if __name__ == '__main__':
    main()
