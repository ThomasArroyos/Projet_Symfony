function formaterHeure(HTMLScriptElement, start=true) {
    console.log(HTMLScriptElement.end.toString())
    let datetime_locale_format
    if (start===true && HTMLScriptElement.start !== null) {
        datetime_locale_format = HTMLScriptElement.start.toString().split(" ")[3]+"-"
        switch (HTMLScriptElement.start.toString().split(" ")[1]) {
            case "Jan": datetime_locale_format += "01-";
                break;
            case "Feb": datetime_locale_format += "02-";
                break;
            case "Mar": datetime_locale_format += "03-";
                break;
            case "Apr": datetime_locale_format += "04-";
                break;
            case "May": datetime_locale_format += "05-";
                break;
            case "Jun": datetime_locale_format += "06-";
                break;
            case "Jul": datetime_locale_format += "07-";
                break;
            case "Aug": datetime_locale_format += "08-";
                break;
            case "Sep": datetime_locale_format += "09-";
                break;
            case "Oct": datetime_locale_format += "10-";
                break;
            case "Nov": datetime_locale_format += "11-";
                break;
            case "Dec": datetime_locale_format += "12-";
                break;
        }
        if (parseInt(HTMLScriptElement.start.toString().split(" ")[4].split(":")[0],10)<11) {
            datetime_locale_format += HTMLScriptElement.start.toString().split(" ")[2]+"T0"+(parseInt(HTMLScriptElement.start.toString().split(" ")[4].split(":")[0],10)-1).toString()+":"+HTMLScriptElement.start.toString().split(" ")[4].split(":")[1]
        } else {
            datetime_locale_format += HTMLScriptElement.start.toString().split(" ")[2]+"T"+(parseInt(HTMLScriptElement.start.toString().split(" ")[4].split(":")[0],10)-1).toString()+":"+HTMLScriptElement.start.toString().split(" ")[4].split(":")[1]
        }
    } else if (start===false && HTMLScriptElement.end !== null) {
        datetime_locale_format = HTMLScriptElement.end.toString().split(" ")[3]+"-"
        switch (HTMLScriptElement.end.toString().split(" ")[1]) {
            case "Jan": datetime_locale_format += "01-";
                break;
            case "Feb": datetime_locale_format += "02-";
                break;
            case "Mar": datetime_locale_format += "03-";
                break;
            case "Apr": datetime_locale_format += "04-";
                break;
            case "May": datetime_locale_format += "05-";
                break;
            case "Jun": datetime_locale_format += "06-";
                break;
            case "Jul": datetime_locale_format += "07-";
                break;
            case "Aug": datetime_locale_format += "08-";
                break;
            case "Sep": datetime_locale_format += "09-";
                break;
            case "Oct": datetime_locale_format += "10-";
                break;
            case "Nov": datetime_locale_format += "11-";
                break;
            case "Dec": datetime_locale_format += "12-";
                break;
        }
        if (parseInt(HTMLScriptElement.end.toString().split(" ")[4].split(":")[0],10)<11) {
            datetime_locale_format += HTMLScriptElement.end.toString().split(" ")[2]+"T0"+(parseInt(HTMLScriptElement.end.toString().split(" ")[4].split(":")[0],10)-1).toString()+":"+HTMLScriptElement.end.toString().split(" ")[4].split(":")[1]
        } else {
            datetime_locale_format += HTMLScriptElement.end.toString().split(" ")[2]+"T"+(parseInt(HTMLScriptElement.end.toString().split(" ")[4].split(":")[0],10)-1).toString()+":"+HTMLScriptElement.end.toString().split(" ")[4].split(":")[1]
        }
    } else if (start===false && HTMLScriptElement.end === null) {
        datetime_locale_format = ""
    }
    return datetime_locale_format
}