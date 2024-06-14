import 'dart:convert';
import 'package:flutter_dotenv/flutter_dotenv.dart';
import 'package:flutter/material.dart';
import 'package:webdirapp/models/entry.dart';
import 'package:http/http.dart' as http;


class EntryProvider extends ChangeNotifier {
  final List<Entry> _entries = [];

  Future<List<Entry>> getEntries(bool sortOrder) async{
    await _fetchEntries(sortOrder);
    return _entries;
  }

  Future<void> _fetchEntries(bool sortOrder) async {
    _entries.clear();
    final response = await http.get(Uri.parse('http://docketu.iutnc.univ-lorraine.fr:54002/api/entrees'));
    if (response.statusCode == 200) {
      final json = jsonDecode(response.body);
      final entriesdata = json['entrees'];
      
      for (var entry in entriesdata) {
        final url = Uri.parse('${dotenv.env['BASE_URL']}${dotenv.env['PORT']}${entry['links']['self']['href']}');
        final entryResponse = await http.get(url);
          if (entryResponse.statusCode != 200) {
            throw Exception('Impossible de charger les Entrynes (code d\'erreur : ${response.statusCode})');
          } else {
            final entrydata = jsonDecode(entryResponse.body)['entree'];
            try {
              final Entry entry = Entry.fromJson(entrydata);
              _entries.add(entry);
            } catch (e) {
              print(e);
            }
          }
      }

      if (sortOrder) {
        _entries.sort((a, b) => a.lastName.compareTo(b.lastName));
      } else {
        _entries.sort((a, b) => b.lastName.compareTo(a.lastName));
      }

    } else {
      throw Exception('Impossible de charger les Entrées (code d\'erreur : ${response.statusCode})');
    }
  }
}