<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kea Control Web</title>
</head>

<!-- super boring style
<style>
    table {

        border-top: 1px dotted;

    }

    td {

        border-top: 1px dotted;
        padding: 3px;

    }
</style> -->


<style>
    :root {
        --bg: #f8f9fa;
        --card: #ffffff;
        --text: #212529;
        --border: #cccccc;
        --header-bg: #e9ecef;
        --accent: #0056b3;
        --danger: #c82333;
    }

    @media (prefers-color-scheme: dark) {
        :root {
            --bg: #121212;
            --card: #1e1e1e;
            --text: #d0d0d0;
            --border: #333333;
            --header-bg: #222222;
            --accent: #4a90e2;
            --danger: #dc3545;
        }
    }

    * {
        box-sizing: border-box;
    }

    body {
        font-family: ui-monospace, SFMono-Regular, Consolas, monospace;
        font-size: 12px;
        background: var(--bg);
        color: var(--text);
        margin: 0;
        padding: 10px;
    }

    a {
        color: var(--accent);
        text-decoration: none;
    }

    h1 {
        font-size: 1.3rem;
        margin: 0 0 10px 0;
    }

    h2 {
        font-size: 1.1rem;
        border-bottom: 1px solid var(--border);
        padding-bottom: 2px;
        margin: 12px 0 6px 0;
    }

    h3 {
        font-size: 0.95rem;
        margin: 8px 0 4px 0;
    }

    h4 {
        font-size: 0.85rem;
        color: var(--accent);
        margin: 6px 0 4px 0;
    }

    table {
        /* width: 100%; */
        max-width: 100%;
        border-collapse: collapse;
        background: var(--card);
        border: 1px solid var(--border);
        margin-bottom: 10px;
        font-size: 11px;
    }

    th,
    td {
        padding: 3px 5px;
        border: 1px solid var(--border);
        text-align: left;
        word-break: break-word;
    }

    th {
        background: var(--header-bg);
        font-weight: bold;
    }

    input[type="text"],
    input[type="password"],
    input[type="number"],
    select {
        background: var(--bg);
        color: var(--text);
        border: 1px solid var(--border);
        padding: 2px 4px;
        font-family: inherit;
        font-size: 11px;
        max-width: 100%;
    }

    button {
        background: var(--card);
        color: var(--text);
        border: 1px solid var(--border);
        padding: 2px 6px;
        font-family: inherit;
        font-size: 11px;
        cursor: pointer;
    }

    button[value*="del"] {
        color: var(--danger);
        border-color: var(--danger);
    }

    pre {
        background: var(--card);
        padding: 6px;
        border: 1px solid var(--border);
        overflow-x: auto;
        font-size: 11px;
        max-width: 100%;
    }
</style>