#!/bin/bash
function menu {
  echo -e "Simple tools Git Bash\n"

  echo -e "0) Git Init"
  echo -e "1) Git Clone"
  echo -e "2) Git Push"
  echo -e "3) Git Remote"
  echo -e "4) Git Tag"

  echo -e "\nUse 'q' for quit"
  echo -n "Your choice: "
  read choice


}

menu

case "$choice" in
   0) clear
      git init
      echo -e "\n"
      menu
      ;;

   1)
      clear
      echo -e "Clone some project?"
      echo -n "Enter URL clone here (use 'q' for quit): "
      read url
      regex='(https?|ssh)://[-A-Za-z0-9\+&@#/%?=~_|!:,.;]*[-A-Za-z0-9\+&@#/%=~_|]'

      if [[ $url =~ $regex ]]; then
         git clone $url
         menu
      else
          if [ $url == 'q' ]; then
	          exit 0;
          fi

         echo -e "Invalid URL for Git Clone"
      fi

      ;;

   2)
      clear
      echo -e "use : \n. (all folder and file) \n-A (all file) \nOr you can type filename ex. \"git.sh\" or \"git*\"\n"
      echo -n "Upload your file/folder : "
      # echo -n "File/Folder: "
      read file

      git add $file
      echo -n "Commit for this file: "
      read commit
      git commit -m "$commit"

      echo -n "Push as origin (default) or another [Press Enter to use default]: "
      read origin

      if [ -z "$origin" ];then
         origin="origin"    
         git push -u "$origin" master
         menu
      else
         git push -u "$origin" master
         menu
      fi
      ;;

    3)
      clear
      echo -e "\nRemote  project"
      echo -n "Enter URL remote here (use 'q' for quit): "
      read remote
      regex='(https?|ssh)://[-A-Za-z0-9\+&@#/%?=~_|!:,.;]*[-A-Za-z0-9\+&@#/%=~_|]'

      if [[ $remote =~ $regex ]]; then
         git remote add origin $remote
      else
          if [ $remote == 'q' ]; then
            exit 0;
          fi

         echo -e "Invalid URL for Git Remote"
      fi

      ;;
    
    4)
      clear
      last_version=$(git tag | tail -n 1)
      echo -e "Last Version Create: $last_version"
      echo -n "Tag version: "
      read new_version
      echo "v$new_version"

      git tag -a "v$new_version" -m "Release v$new_version";
      git push origin "v$new_version";
      echo "Current version: v$new_version";
      # version=$(git tag | tail -n 1 | perl -pe 's/\v//g;s/\\.//g;$_++;s/(\d)/$1./g;s/\\.$/\n/')
      ;;
    q)
      exit 0;
      ;;
    *)
      echo -e "Wrong choice"
      exit 1
      ;;
esac
