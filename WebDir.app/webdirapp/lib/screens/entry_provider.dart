import 'dart:convert';
import 'package:flutter_dotenv/flutter_dotenv.dart';
import 'package:flutter/material.dart';
import 'package:webdirapp/models/entry.dart';
import 'package:http/http.dart' as http;


class EntryProvider extends ChangeNotifier {
  final List<Entry> _entries = [];
  final List<DropdownMenuItem<String>> _services = [];

  Future<List<Entry>> getEntries(bool sortOrder, String? researchValue, String? filterValue) async{
    await _fetchEntries(sortOrder,researchValue,filterValue);
    return _entries;
  }

  List<DropdownMenuItem<String>> getServices() {
    _fetchServices();
    return _services;
  }

  Future<void> _fetchEntries(bool sortOrder, String? researchValue, String? filterValue) async {
    _entries.clear();
    final List<Entry> entriesCopy = [];
    final String url = filterValue != null ? '${dotenv.env['BASE_URL']}${dotenv.env['PORT']}/api/services/$filterValue/entrees' : '${dotenv.env['BASE_URL']}${dotenv.env['PORT']}/api/entrees';
    final response = await http.get(Uri.parse(url), headers: {'Accept-Charset': 'utf-8'});
    if (response.statusCode == 200) {
      final json = jsonDecode(utf8.decode(response.bodyBytes));
      final entriesdata = json['entrees'];
      
      
      for (var entry in entriesdata) {
        final url = Uri.parse('${dotenv.env['BASE_URL']}${dotenv.env['PORT']}${entry['links']['self']['href']}');
        final entryResponse = await http.get(url, headers: {'Accept-Charset': 'utf-8'});
          if (entryResponse.statusCode != 200) {
            throw Exception('Impossible de charger les Entrynes (code d\'erreur : ${response.statusCode})');
          } else {
            final entrydata = jsonDecode(utf8.decode(entryResponse.bodyBytes));
              final Entry entry = Entry.fromJson(entrydata);
                if(researchValue != null && researchValue.isNotEmpty){
                   String fullInfo = '${entry.firstName} ${entry.lastName} ${entry.email} ${entry.numBureau}'.toLowerCase();
                  if(fullInfo.contains(researchValue)){
                    entriesCopy.add(entry);
                  }
                }
             
              _entries.add(entry);

          }
      }
    } else {
      throw Exception('Impossible de charger les Entrées (code d\'erreur : ${response.statusCode})');
    }

    if(researchValue != null && researchValue.isNotEmpty){
      _entries.clear();
      _entries.addAll(entriesCopy);
    }

    if (sortOrder) {
      _entries.sort((a, b) => a.lastName.compareTo(b.lastName));
    } else {
      _entries.sort((a, b) => b.lastName.compareTo(a.lastName));
    }
  }

  Future<void> _fetchServices() async {
    _services.clear();
    _services.add(
      const DropdownMenuItem(
      value: null,
      child: Text("Aucun filtre"),
      )
      );
    final response = await http.get(Uri.parse('${dotenv.env['BASE_URL']}${dotenv.env['PORT']}/api/services'), headers: {'Accept-Charset': 'utf-8'});
    if (response.statusCode == 200) {
      final json = jsonDecode(utf8.decode(response.bodyBytes));
      final servicesdata = json['services'];
      for (var service in servicesdata) {
        String nom = service['service']['nom'];
        _services.add(
          DropdownMenuItem(
          value: service['service']['id'].toString(),
          child: Text(nom),
          )
          );
      }
    } else {
      throw Exception('Impossible de charger les services (code d\'erreur : ${response.statusCode})');
    }

  }
}