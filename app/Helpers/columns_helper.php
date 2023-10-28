<?php

function userColumns()
{
    return ['id', 'name'];
}

function userArrayData($data, $field)
{
    return [$data[$field]['id'] ?? '', $data[$field]['name'] ?? ''];
}

function roleColumns()
{
    return ['id', 'name'];
}

function roleArrayData($data, $field)
{
    return [$data[$field]['id'] ?? '', $data[$field]['name'] ?? ''];
}

function permissionColumns()
{
    return ['id', 'name'];
}

function permissionArrayData($data, $field)
{
    return [$data[$field]['id'] ?? '', $data[$field]['name'] ?? ''];
}
