import 'package:flutter/material.dart';
import 'package:webdirapp/screens/directory_master.dart';

class WebDirApp extends StatefulWidget {
  const WebDirApp({super.key});

  @override
  State<WebDirApp> createState() => _WebDirAppState();
}

class _WebDirAppState extends State<WebDirApp> {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Web Directory',
      home: Scaffold(
        appBar: AppBar(
          title: const Text('Annuaire Web'),
          backgroundColor: Colors.yellow,
        ),
        body: const Center(
          child: DirectoryMaster(),
        )
      ),
      theme: ThemeData(
        primarySwatch: Colors.yellow,
      ),
    );
  }
}