import time
import pyautogui

def auto_click(interval, item_count, required_item_amount):
    while True:
        pyautogui.click()
        print("Create...")
        time.sleep(interval)
        if interval == interval: 
            pyautogui.click()
            print("Collect...")
            time.sleep(2.5)
            item_count -= required_item_amount
            print(item_count)
        
        if item_count < required_item_amount:
            print("Done")
            break
            

if __name__ == "__main__":
    auto_click(28, 86, 2)


# brick - 124 seconds
# ironite bar - 34 seconds
# popberry pie - 28 seconds
# pancakes - 20 seconds
# plain Omelet - 14 seconds
# cart of ironite bar - 364 seconds
# flour - 64 seconds
# grumpkin loaf - 109 seconds
# Scarrot Pie - 52 seconds
# grumpin wine - 304



